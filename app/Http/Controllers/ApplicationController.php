<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Response;

class ApplicationController extends Controller
{
    public function index(): Response
    {
        $data = [
            'products' => Product::with(
                'image',
                'additionalImages',
                'category',
                'type'
            )->sorted(),
            'categories' => ProductCategory::with('types')->get(),
        ];

        return response()->view('application', $data);
    }
}
