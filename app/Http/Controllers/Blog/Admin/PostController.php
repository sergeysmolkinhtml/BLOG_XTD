<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);

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
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostCreateRequest $request): RedirectResponse
    {
        $data = $request->input();

        $item = (new BlogPost())->create($data);

        if($item){
            $job = new BlogPostAfterCreateJob($item);
            $this->dispatch($job);

            return redirect()->route('blog.admin.posts.edit',[$item->id])
                ->with(['success' => 'Saved successfully']);
        }else{
            return back()->withErrors(['msg'=>'Error saving'])
                ->withInput();
        }

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
    public function edit(string $id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
            compact('item','categoryList'));

    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(BlogPostUpdateRequest $request, string $id): RedirectResponse
    {
       $item = $this->blogPostRepository->getEdit($id);

       if(empty($item)){
           return back()
               ->withErrors(['msg' => "Article id = $id not found"])
               ->withInput();
       }

        $data = $request->all();

        $result = $item->update($data);

        if($result){
            return redirect()
                ->route('blog.admin.posts.edit',$item->id)
                ->with(['success' => 'Successfully saved']);
        } else {
            return back()
                ->withErrors(['msg' => 'Error saving'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $id): RedirectResponse
    {
        /*dd(__METHOD__ , $id, \request()->all());*/

       $result = BlogPost::destroy($id);

       //$result = BlogPost::find($id)->forceDelete();


       if ($result){
           BlogPostAfterDeleteJob::dispatch($id);
           return redirect()->route('blog.admin.posts.index')
               ->with(['success' => "Record id $id deleted"]);
       }else{
           return back()->withErrors(['msg' => 'Error deleting']);
       }

    }
}
