<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductImage;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function products(): JsonResponse
    {
        return response()->json(
            Product::with('image', 'category', 'type', 'additionalImages')->sorted()
        );
    }
}
