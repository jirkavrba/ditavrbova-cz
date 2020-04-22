@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('products.index') }}">Správa produktů</a>
    </li>
    <li class="breadcrumb-item active">Přidat nový produkt</li>
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
        $("#image").imagepicker();
    </script>
@endpush

@section('main')
    <h1 class="mt-5 mb-2">Přidat nový produkt</h1>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Název produktu</label>
                                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="in_stock">Dostupnost</label>
                                    <select name="in_stock" id="in_stock" class="form-control">
                                        <option value="1">Skladem</option>
                                        <option value="0">Na objednávku</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="category_type">Zařazení</label>
                                    <select name="category_type" id="category_type" class="form-control" required>
                                        @foreach($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->types as $type)
                                                    <option value="{{ $category->id }}:{{ $type->id }}">
                                                        {{ $category->name }} &raquo; {{ $type->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="preference">Preferenční koeficient</label>
                                    <select name="preference" id="preference" class="form-control">
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description">Popis</label>
                                    <textarea name="description" id="description" rows="8" class="form-control"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="specifications">Specifikace</label>
                                    <textarea name="specifications" id="specifications" rows="8" class="form-control"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-block btn-primary">Přidat</button>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="image">Hlavní obrázek</label>
                                    <select name="image" id="image" required>
                                        @foreach($images as $image)
                                            <option value="{{ $image->id }}" data-img-src="{{ $image->url }}"></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-block btn-primary">Přidat</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
