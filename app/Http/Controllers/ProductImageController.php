<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImages\StoreProductImageRequest;
use App\ProductImage;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = [
            'images' => ProductImage::all()
        ];

        return response()->view('images.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductImageRequest $request
     * @return Response
     */
    public function store(StoreProductImageRequest $request): Response
    {
        /** @var UploadedFile $image */
        $file = $request->file('image');
        $path = $file->store('images', 's3');

        $image = new ProductImage(['path' => $path]);
        $image->save();

        // HTTP 200 ok response
        return response('ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductImage $image
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ProductImage $image): RedirectResponse
    {
        Storage::delete($image->path);
        $image->delete();

        return redirect()->route('images.index');
    }
}
