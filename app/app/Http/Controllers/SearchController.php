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
        $tag = $request->input('tag');
        $posts = PetsnsItem::query();

        if (!empty($keyword)) {
            $posts->where(function ($query) use ($keyword) {
                $query->where('comment', 'LIKE', "%{$keyword}%")
                      ->orWhereHas('user', function ($subquery) use ($keyword) {
                          $subquery->where('name', 'LIKE', "%{$keyword}%");
                      });
            });
        }

        if (!empty($tag)) {
            $posts->where('tag', 'LIKE', "%{$tag}%");
        }

        if ($request->has('type') && $request->input('type') !== null) {
            $animalType = $request->input('type');
            $posts->where('animal_type', $animalType);
            if ($request->has('breed') && $request->input('breed') !== null) {
                $animalBreed = $request->input('breed');
                $posts->where('animal_breed', $animalBreed);
            }
        }

        $posts = $posts->get();

        return view('search.index', compact('posts', 'keyword', 'tag'), ['user' => $user]);
    }

    public function show()
    {
        $user = Auth::user();
        $posts = PetsnsItem::query()->orderBy('created_at', 'desc')->get();

        return view('search.index', compact('posts'), ['user' => $user]);
    }
}
