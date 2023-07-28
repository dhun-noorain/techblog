<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::where('tags', 'LIKE', "%$request->tag%")
                    ->latest()
                    ->paginate(10);

        return view('posts.index', compact('posts'));
    }
}
