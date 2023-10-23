<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {
        $like = Auth::user()->like($id);
        return back();
    }

    public function destroy(Request $request, $id)
    {
        Auth::user()->unlike($id);
        return back();
    }
}
