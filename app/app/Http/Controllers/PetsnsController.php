<?php

namespace App\Http\Controllers;

use App\Models\PetsnsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;


class PetsnsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * フォローしているのユーザーの投稿を表示する
     */
    public function index(Request $request)
    {
        //投稿を作成日順で表示する
        $user = Auth::user();
        $follows = $user->follows()->pluck('id')->toArray();
        array_push($follows,$user->id);
        $pets = PetsnsItem::whereIn('user_id', $follows)->orderBy('created_at', 'desc')->get();

        return view('pet.index', compact('pets'), ['user' => $user]);

    }


    /**
     * 投稿新規作成画面
     */
    public function create()
    {
        $user = Auth::user();
        return view('pet.create', ['user' => $user]);
    }

    /**
     * 投稿を作成する
     */
    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|max:10240|mimes:jpeg,gif,png,jpg',
            'comment' => 'required|max:200',
        ]);

        $img = $request->file('picture');
        $path = $img->store('img','public');

        PetsnsItem::create(
            [
                'user_id' => Auth::id(),
                'path' => $path,
                'comment' => $request->comment,
            ]
        );
        return redirect()->route('pet.index');
    }


    /**
     * 投稿の表示
     */
    public function show($id)
    {
        $pet = PetItem::find($id);
        $count_like_users = $pet->like_users()->count();
        $data=[
               'count_like_users'=>$count_like_users,
              ];
        
        return view('pet.show', compact('pet'), ['count' => $data]);
    }

    /**
     * 投稿の編集
     */
    public function edit($id)
    {
        $pet = PetsnsItem::find($id);

        return view('pet.edit', compact('pet'));
    }

    /**
     * 投稿の更新(コメントのみ編集可能)
     */
    public function update($id, Request $request)
    {
        $request->validate([            
            'comment' => 'required|max:200',
        ]);

        $pet = PetsnsItem::find($id);
        $pet->comment = $request->comment;
        $pet->save();

        return redirect()->route('pet.index');
    }

    /**
     * 投稿の削除
     */
    public function destroy($id)
    {
        $pet = PetsnsItem::find($id);
        if ($pet != null){
            $pet->delete();
            if (Storage::exists('public/img/'.$pet->path)) {
                Storage::delete('public/img/'.$pet->path);
            }
        }

        return redirect()->route('pet.index');
    }

}
