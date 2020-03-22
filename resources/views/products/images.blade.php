@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('products.index') }}">Produkty</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
    </li>
    <li class="breadcrumb-item active">Nastavení doplňujících obrázků</li>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://rvera.github.io/image-picker/image-picker/image-picker.css">
    <style>
        .image_picker_image {
            width: 150px;
            height: 150px;
        }
        .thumbnail.selected {
            background: #df691a !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://rvera.github.io/image-picker/image-picker/image-picker.js"></script>
    <script>
        $("#images").imagepicker();
    </script>
@endpush

@section('main')
    <h1 class="mt-5 mb-2">Doplňující obrázky pro produkt {{ $product->name }}</h1>

    <form action="{{ route('additional-images.store', $product) }}" method="post" class="mt-2">
        @csrf
        <div class="row">
            <div class="col-sm-12 pt-4">
                <select name="images[]" id="images" multiple>
                    @foreach($images as $image)
                        <option value="{{ $image->id }}" data-img-src="{{ $image->url }}"></option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12">
                <button class="mt-2 btn btn-primary">Uložit</button>
            </div>
        </div>
    </form>
@endsection
