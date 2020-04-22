<?php

namespace App\Http\Controllers;


use App\AdditionalProductImage;
use App\Product;
use App\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdditionalProductImageController extends Controller
{
    public function create(Product $product): Response
    {
        $data = [
            'product' => $product,
            'selected' => $product->additionalImages->pluck('id'),
            'images' => ProductImage::all(),
        ];

        return response()->view('products.images', $data);
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        // Delete all existing relationships
        AdditionalProductImage::where('product_id', $product->id)->delete();

        $images = collect($request->input('images'));
        $relations = $images->map(function ($image) use ($product) {
            return [
                'image_id' => $image,
                'product_id' => $product->id,
            ];
        });

        AdditionalProductImage::insert($relations->toArray());

        return redirect()->route('products.show', $product);
    }
}
