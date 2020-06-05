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
    public function categories()
    {
        return response()->json(ProductCategory::with('types')->get());
    }

    public function product(Product $product)
    {
        if (!$product->visible)
        {
            throw new ModelNotFoundException();
        }

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

    public function products(): JsonResponse
    {
        $products = Product::with('additionalImages', 'image')->visible()->sorted();
        $products = $this->format($products);

        return response()->json($products);
    }

    public function category(ProductCategory $category)
    {
        $products = $category->products()->with('additionalImages', 'image')->visible()->get();
        $products = $this->format($products);

        return response()->json($products);
    }

    public function type(ProductType $type)
    {
        $products = $type->products()->with('additionalImages', 'image')->visible()->get();
        $products = $this->format($products);

        return response()->json($products);
    }

    private function format(Collection $products)
    {
        return $products->map(fn(Product $product) => [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category_id,
                'type' => $product->type_id,
                'slug' => $product->slug,
                'in_stock' => $product->in_stock,
                'images' => collect($product->imageUrl)->concat($product->additionalImages->pluck('url'))
            ])
            ->values();
    }
}
