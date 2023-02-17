<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = DB::table('blog_categories')->paginate(15);

        return view('blog.admin.categories.index',compact('paginator'));
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
    public function edit(string $id)
    {
        $item = BlogCategory::findOrFail($id);

        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $item = BlogCategory::find($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Record id=[{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->fill($data)->save();

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
