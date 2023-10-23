<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }

    public function store(Request $request)
   {
       $comment = new Comment();
       $comment->comment = $request->comment;
       $comment->post_id = $request->post_id;
       $comment->user_id = Auth::user()->id;
       $comment->save();

       return redirect('/');
   }

    public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();

        return redirect('/');
    }
}
