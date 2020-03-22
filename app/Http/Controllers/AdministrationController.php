<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\ProductType;
use Illuminate\Http\Response;

class AdministrationController extends Controller
{
    public function index(): Response
    {
        $data = [
            'images' => ProductImage::count(),
            'products' => Product::count(),
            'categories' => ProductCategory::count(),
            'types' => ProductType::count(),
        ];

        return response()->view('administration', $data);
    }
}
