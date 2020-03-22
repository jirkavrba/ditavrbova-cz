<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductImage;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function images(): JsonResponse
    {
        return response()->json(ProductImage::all());
    }

    public function categories(): JsonResponse
    {
        return response()->json(ProductCategory::with('types')->get());
    }

    public function products(): JsonResponse
    {
        return response()->json(Product::with('image', 'additionalImages')->sorted());
    }
}
