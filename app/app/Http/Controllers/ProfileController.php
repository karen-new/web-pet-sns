<?php

namespace App\Http\Controllers;

use App\Models\PetsnsItem;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \InterventionImage;
use Illuminate\Support\Facades\Hash;

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
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * プロフィールの更新
     */
    public function update(Request $request)
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

    /**
     * ユーザーの削除
     */
    public function destroy()
{
    $user = Auth::user();
    $user->delete();

    return redirect()->route('home')->with('success', 'アカウントが削除されました。');
}

    /**
     * プロフィールの個人情報編集
     */
    public function personalEdit()
    {
        $user = Auth::user();
        return view('profile.personal', compact('user'));
    }

    /**
     * emailの更新
     */
    public function emailUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.personal')->with('success', 'メールアドレスが変更されました。');

    }

    /**
     * passwordの更新
     */
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('profile.personal')->with('success', 'パスワードが変更されました。');
        } else {
            return redirect()->route('profile.personal')->with('error', '現在のパスワードが正しくありません。');
        }
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
