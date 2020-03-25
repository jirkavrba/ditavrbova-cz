<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\ProductType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use stdClass;

class ApiController extends Controller
{
    private const PRODUCTS_PER_PAGE = 15;

    public function categories()
    {
        return response()->json(ProductCategory::with('types')->get());
    }

    public function product(Product $product)
    {
        $data = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'specifications' => $product->specifications,
            'category' => $product->category->name,
            'type' => $product->type->name,
            'image' => $product->imageUrl,
            'images' => $product->additionalImages->pluck('url'),
            'in_stock' => (bool)$product->in_stock
        ];

        return response()->json($data);
    }

    public function products(int $page = 1): JsonResponse
    {
        $products = $this->format(Product::with('additionalImages', 'image')->sorted(), $page);

        if ($products->isEmpty()) {
            throw new ModelNotFoundException();
        }

        return response()->json($products);
    }

    public function category(ProductCategory $category, int $page = 1)
    {
        $products = $category->products()->with('additionalImages', 'image')->get();
        $products = $this->format($products, $page);

        if ($products->isEmpty()) {
            throw new ModelNotFoundException();
        }

        return response()->json($products);
    }

    public function type(ProductType $type, int $page = 1)
    {
        $products = $type->products()->with('additionalImages', 'image')->get();
        $products = $this->format($products, $page);

        if ($products->isEmpty()) {
            throw new ModelNotFoundException();
        }

        return response()->json($products);
    }

    private function format(Collection $products, int $page)
    {
        return $products->forPage($page, self::PRODUCTS_PER_PAGE)
            ->map(fn(Product $product) => [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category_id,
                'type' => $product->type_id,
                'slug' => $product->slug,
                'images' => collect($product->imageUrl)->concat($product->additionalImages->pluck('url'))
            ])
            ->values();
    }
}
