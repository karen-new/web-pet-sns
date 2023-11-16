<?php

namespace App\Http\Controllers;

use App\Models\PetsnsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
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
        $posts = PetsnsItem::whereIn('user_id', $follows)->orderBy('created_at', 'desc')->get();

        return view('post.index', compact('posts'), ['user' => $user]);
    }

    /**
     * 投稿新規作成画面
     */
    public function create()
    {
        $user = Auth::user();
        return view('post.create', ['user' => $user]);
    }

    /**
     * 投稿を作成する
     */
    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|file|mimes:jpeg,gif,png,jpg',
            'comment' => 'required|max:200',
        ]);

        $image = $request->file('picture');

        // バケットへアップロードする
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        $user = Auth::user();

        PetsnsItem::create(
            [
                'user_id' => Auth::id(),
                'path' => Storage::disk('s3')->url($path),
                'comment' => $request->comment,
                'animal_type' => $request->type,
                'animal_breed' => $request->breed,
            ]
        );

        return redirect()->route('post.index');
    }


    /**
     * 投稿の表示
     */
    public function show($id)
    {
        $post = PetsnsItem::find($id);
        $count_like_users = $post->like_users()->count();
        $data=[
               'count_like_users'=>$count_like_users,
              ];

        return view('post.show', compact('post'), ['count' => $data]);
    }

    /**
     * 投稿の編集
     */
    public function edit($id)
    {
        $post = PetsnsItem::find($id);

        return view('post.edit', compact('post'));
    }

    /**
     * 投稿の更新(コメントのみ編集可能)
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'comment' => 'required|max:200',
        ]);

        $post = PetsnsItem::find($id);
        $post->comment = $request->comment;
        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * 投稿の削除
     */
    public function destroy($id)
    {
        $post = PetsnsItem::find($id);
        if ($post != null){
            $post->delete();
            if (Storage::exists('public/img/'.$post->path)) {
                Storage::delete('public/img/'.$post->path);
            }
        }

        return redirect()->route('post.index');
    }

}
