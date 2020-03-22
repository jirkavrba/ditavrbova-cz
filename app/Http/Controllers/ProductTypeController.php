<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypes\DeleteProductTypeRequest;
use App\Http\Requests\ProductTypes\StoreProductTypeRequest;
use App\Http\Requests\ProductTypes\UpdateProductTypeRequest;
use App\Product;
use App\ProductCategory;
use App\ProductType;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = [
            'categories' => ProductCategory::all(),
            'types' => ProductType::all()->groupBy('category_id'),
        ];

        return response()->view('types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $data = [
            'categories' => ProductCategory::all(),
        ];

        return response()->view('types.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductTypeRequest $request): RedirectResponse
    {
        $type = new ProductType([
            'name' => $request->input('name'),
            'category_id' => $request->input('category'),
        ]);

        $type->save();
        $type->generateSlug();

        return redirect()->route('types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductType $type
     * @return Response
     */
    public function edit(ProductType $type): Response
    {
        $data = [
            'type' => $type,
            'types' => ProductType::all(),
            'categories' => ProductCategory::all(),
        ];

        return response()->view('types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductTypeRequest $request
     * @param ProductType $type
     * @return RedirectResponse
     */
    public function update(UpdateProductTypeRequest $request, ProductType $type): RedirectResponse
    {
        $type->update([
            'name' => $request->get('name'),
            'category_id' => $request->get('category'),
        ]);

        $type->generateSlug();

        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteProductTypeRequest $request
     * @param ProductType $type
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(DeleteProductTypeRequest $request, ProductType $type): RedirectResponse
    {
        $type->products()->update(['type_id' => $request->input('type')]);
        $type->delete();

        return redirect()->route('types.index');
    }
}
