<?php

namespace App\Http\Controllers;

use App\Models\PetsnsItem;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \InterventionImage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 自分のプロフィールと投稿を表示する
     */
    public function index($id)
    {
        $user = User::find($id);
        $posts = PetsnsItem::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('profile.index', compact('posts'), ['user' => $user]);
    }

    /**
     * プロフィールの編集
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * プロフィールの更新
     */
    public function update($id, Request $request)
    {
        $request->validate([            
            'picture' => 'max:1024|mimes:jpeg,gif,png,jpg',
            'name' => 'required|max:20',
            'introduction' => 'max:100',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->introduction = $request->introduction;

        $img = $request->file('image');
        // InterventionImage::make($img)->resize(1080, 700);
        if ($img != null) {
            $path = $img->store('user','public');
            $user->picture = $path;
        }

        $user->save();

        return redirect()->route('profile.index', $user->id);
    }

    public function follow($id)
    {
        $user = User::find($id);
        auth()->user()->follows()->attach($user);

        return back();
    }

    public function unfollow($id)
    {
        $user = User::find($id);
        auth()->user()->follows()->detach($user);
       
        return back();
    }
}