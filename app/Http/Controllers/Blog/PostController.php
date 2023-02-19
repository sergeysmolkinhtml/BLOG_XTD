<?php

namespace App\Http\Controllers\Blog;


use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $items = BlogPost::all();

        return view('blog.posts.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        dd(__METHOD__);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        dd(__METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
      dd(__METHOD__);
    }
}
