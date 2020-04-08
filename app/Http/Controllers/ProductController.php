<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = ['products' => Product::with('image')->sorted()];

        return response()->view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $data = [
            'categories' => ProductCategory::with('types')->get(),
            'images' => ProductImage::all(),
        ];

        return response()->view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $category_type = explode(':', $request->input('category_type'));

        $product = new Product([
            'name' => $request->input('name'),
            'in_stock' => $request->input('in_stock'),
            'preference' => $request->input('preference'),
            'description' => $request->input('description'),
            'specifications' => $request->input('specifications'),
            'type_id' => $category_type[1],
            'image_id' => $request->input('image'),
            'category_id' => $category_type[0],
        ]);

        $product->save();
        $product->generateSlug();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
        $data = ['product' => $product];

        return response()->view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $data = [
            'categories' => ProductCategory::with('types')->get(),
            'images' => ProductImage::all(),
            'product' => $product,
        ];

        return response()->view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $category_type = explode(':', $request->input('category_type'));

        $product->update([
            'name' => $request->input('name'),
            'in_stock' => $request->input('in_stock'),
            'preference' => $request->input('preference'),
            'description' => $request->input('description'),
            'specifications' => $request->input('specifications'),
            'type_id' => $category_type[1],
            'image_id' => $request->input('image'),
            'category_id' => $category_type[0],
        ]);

        $product->generateSlug();

        return redirect()->route('products.show', $product);
    }

    public function toggleVisibility(Product $product): RedirectResponse
    {
        $product->visible = !$product->visible;
        $product->save();

        return redirect()->back();
    }

    public function addPersonalNote(Product $product, Request $request)
    {
        $product->personal_note = $request->input('note');
        $product->save();

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->additionalImages()->delete();
        $product->delete();

        return redirect()->route('products.index');
    }
}
