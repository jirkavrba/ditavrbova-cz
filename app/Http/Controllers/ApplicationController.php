<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ApplicationController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->to('https://ditavrbova.cz');
    }
}
