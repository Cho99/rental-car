<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo
    ) {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->getTrademark();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepo->getTrademark();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $price = 0;
        $result = $this->categoryRepo->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'price' => $price,
        ]);
        if ($result) {
            return redirect()->route('admin.categories.index')->with('infoMessage',
                trans('message.category_create_success'));
        }

        return redirect()->route('admin.categories.index')->with('infoMessage',
            trans('message.category_create_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->categoryRepo->findOrFail($id);
        $categories = $this->categoryRepo->load($model, 'children');
        
        return view('admin.category.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepo->findOrFail($id);
        $categories = $this->categoryRepo->getTrademark();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if ($request->parent_id == $id) {
            return redirect()->back()->with('infoMessage',
                trans('message.category_edit_fail'));
        }
        $price = 0;
        $result = $this->categoryRepo->update($id, [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'price' => $price,
        ]);
        if ($result) {
            return redirect()->route('admin.categories.index')->with('infoMessage',
                trans('message.category_update_success'));
        }

        return redirect()->route('admin.categories.index')->with('infoMessage',
            trans('message.category_update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->categoryRepo->destroy($id);
        if ($result) {
            return redirect()->route('admin.categories.index')->with('infoMessage',
                trans('message.category_delete_success'));
        }

        return redirect()->route('admin.categories.index')->with('infoMessage',
            trans('message.category_delete__fail'));
    }
}
