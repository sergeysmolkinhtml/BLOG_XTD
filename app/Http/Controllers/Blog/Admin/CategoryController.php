<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Repositories\BlogCategoryRepository;

/*
 * Manage Blog Categories
 */


class CategoryController extends BaseController
{

    /**
     * @var BlogCategoryRepository
     */
    private mixed $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    public function index()
    {
       $paginator = $this->blogCategoryRepository->getAllWithPaginate(18);

       return view('blog.admin.categories.index',
              compact('paginator'));
    }


    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
               compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request): RedirectResponse
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }

        $item = (new BlogCategory($data));
        $item->save();

        //$item = (new BlogCategory())->create($data);

        if ($item instanceof BlogCategory){
            return redirect()->route('blog.admin.categories.edit',[$item->id])
                ->with(['success' => ' Successfully added']);
        }else{
            return back()->withErrors(['msg' => 'Error saving'])
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
    public function edit(string $id, BlogCategoryRepository $categoryRepository)
    {
        $item = $categoryRepository->getEdit($id);

        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     * @param BlogCategoryUpdateRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, string $id): RedirectResponse
    {

        $item = BlogCategory::find($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Record id=[{$id}] not found"])
                ->withInput();
        }


        $data = $request->all();

        $result = $item->update($data);

        if($result){
            return redirect()
                ->route('blog.admin.categories.edit',$item->id)
                ->with(['success'=> 'Successfully saved']);
        }else{
            return back()
                ->withErrors(['msg'=>'Error saving'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        dd(__METHOD__);
    }
}
