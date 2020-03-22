<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategories\DeleteProductCategoryRequest;
use App\Http\Requests\ProductCategories\StoreProductCategoryRequest;
use App\Http\Requests\ProductCategories\UpdateProductCategoryRequest;
use App\ProductCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = ['categories' => ProductCategory::all()];

        return response()->view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductCategoryRequest $request): RedirectResponse
    {
        $category = new ProductCategory(['name' => $request->input('name')]);
        $category->save();
        $category->generateSlug();

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCategory $category
     * @return Response
     */
    public function edit(ProductCategory $category): Response
    {
        $data = [
            'category' => $category,
            'categories' => ProductCategory::all(),
        ];

        return response()->view('categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductCategoryRequest $request
     * @param ProductCategory $category
     * @return RedirectResponse
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $category): RedirectResponse
    {
        $category->update(['name' => $request->input('name')]);
        $category->save();
        $category->generateSlug();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteProductCategoryRequest $request
     * @param ProductCategory $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(DeleteProductCategoryRequest $request, ProductCategory $category): RedirectResponse
    {
        $category->types()->update(['category_id' => $request->input('category')]);
        $category->products()->update(['category_id' => $request->input('category')]);
        $category->delete();

        return redirect()->route('categories.index');
    }
}
