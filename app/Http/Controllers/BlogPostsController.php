<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPostsRequest;
use App\Http\Requests\UpdateBlogPostsRequest;
use App\Models\BlogPosts;

class BlogPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogPosts = BlogPosts::all();

        return view('welcome', ['blogPosts' => $blogPosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $blogPost = BlogPosts::where('slug', $slug)->first();

        return view('article', ['post' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPosts $blogPosts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostsRequest $request, BlogPosts $blogPosts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPosts $blogPosts)
    {
        //
    }
}
