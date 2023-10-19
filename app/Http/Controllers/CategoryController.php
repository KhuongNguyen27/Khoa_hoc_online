<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $categoryService;
    /**
     * Create class Category.
     */
    function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorize('viewAny',Category::class);
            $items = $this->categoryService->paginate(5);
            return view('admin.categories.index',compact('items'));
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorize('create',Category::class);
            return view('admin.categories.create');
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try{
            $data = $request->except(['_token', '_method']);
            $this->categoryService->store($data);
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            // alert()->warning('Have problem, Please try again late!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $this->authorize('view',Category::class);
            $items = $this->categoryService->find($id);
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $this->authorize('update',Category::class);
            $item = $this->categoryService->find($id);
            return view('admin.categories.edit',compact('item'));
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $data = $request->except(['_token', '_method']);
            $this->categoryService->update($data, $id);
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->authorize('delete',Category::class);
            $this->categoryService->destroy($id);
            return back();
        } catch (\Exception $e) {
            Log::error('Bug occurred: ' . $e->getMessage());
        }
    }
}