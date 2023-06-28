<?php

namespace App\Http\Controllers;

use App\Models\PetsnsItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
        /**
     * 投稿の検索
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('keyword');
        $pets = PetsnsItem::query();

        if(!empty($keyword)) {
            $pets->where('comment', 'LIKE', "%{$keyword}%")
            ->orwhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            });
        }

        $posts = $pets->get();

        return view('search.index', compact('posts', 'keyword'), ['user' => $user]);
    }

    public function show()
    {
        $user = Auth::user();
        $pets = PetsnsItem::query()->orderBy('created_at', 'desc')->get();

        return view('search.index', compact('pets'), ['user' => $user]);
    }
}
