<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Rules\PostBodyRule;
use App\Rules\SummaryRule;
use App\Rules\TitleRule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // paginate and fetch posts
        $posts = Post::select('id', 'title', 'summary', 'tags', 'user_id', 'created_at')
            ->latest()
            ->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate posts and store them in DB
        $validated = $request->validate([
            'title' => ['required', new TitleRule],
            'summary' => ['required', new SummaryRule],
            'tags' => ['required'],
            'body' => ['required', new PostBodyRule],
        ]);

        $post = new Post;
        $post->title = $validated['title'];
        $post->summary = $validated['summary'];
        $post->body = $validated['body'];
        $post->tags = trim($validated['tags']);

        $request->user()->posts()->save($post);

        // store and redirect to index page
        return redirect()
            ->route('posts.index')
            ->with('msg', 'Successfully Added Post!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // fetch and show a single post to guest
        $post = Post::find($id);
        $tags = explode(',', $post->tags);
        $len = count($tags);
        if ($len > 1) {
            $tag1 = $tags[rand(0, $len-1)];
            $tag2 = $tags[rand(0, $len-2)];
        } else {
            $tag1 = $tags[0];
            $tag2 = 'html';
        }

        // eloquent for related posts in single post display page (Guest)
        $related = Post::select('title', 'id', 'tags')
            ->where('id', '!=', "$post->id")
            ->where('tags', 'LIKE', "%$tag1%")
            ->orWhere('tags', 'LIKE', "%$tag2%")
            ->limit(3)
            ->get();

        return view('posts.show', ['post' => $post, 'related' => $related]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $post): View
    {
        // fetch post for admin to edit
        $this_post = Post::find($post);
        return view('posts.edit', ['post' => $this_post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post_id)
    {
        // validate and update post
        $validated = $request->validate([
            'title' => ['required', new TitleRule],
            'summary' => ['required', new SummaryRule],
            'tags' => ['required'],
            'body' => ['required', new PostBodyRule],
        ]);

        $post = Post::find($post_id);
        $post->title = $validated['title'];
        $post->summary = $validated['summary'];
        $post->body = $validated['body'];
        $post->tags = trim($validated['tags']);

        $request->user()->posts()->save($post);

        return redirect()
            ->route('posts.edit', $post_id)
            ->with('msg', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        // fetch and delete post
        $post = Post::find($post_id);
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('msg', 'Deleted Successfully');
    }
}
