<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Index', [
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): InertiaResponse
    {
        return Inertia::render('Show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): InertiaResponse
    {
        return Inertia::render('Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): void
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): void
    {
        $post->delete();
    }
}
