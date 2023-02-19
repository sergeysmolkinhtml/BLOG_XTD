<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\BlogPostRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends BaseController
{
    private $blogPostRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(25);

        return view('blog.admin.posts.index',compact('paginator'));
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
