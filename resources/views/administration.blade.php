@extends('layout')

@section('navigation')
    <li class="breadcrumb-item active">Hlavní stránka</li>
@endsection
@section('main')
    <h1 class="mb-4 mt-5">Správa webu</h1>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="display-4">{{ $images }}</h4>
                    Nahraných obrázků
                </div>
                <div class="card-footer">
                    <a href="{{ route('images.index') }}" class="btn btn-block btn-primary">Správa obrázků</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="display-4">{{ $products }}</h4>
                    Produktů
                </div>
                <div class="card-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-block btn-primary">Správa produktů</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="display-4">{{ $categories }}</h4>
                    Kategorií
                </div>
                <div class="card-footer">
                    <a href="{{ route('categories.index') }}" class="btn btn-block btn-primary">Správa kategorií</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="display-4">{{ $types }}</h4>
                    Typů produktu
                </div>
                <div class="card-footer">
                    <a href="{{ route('types.index') }}" class="btn btn-block btn-primary">Správa typů</a>
                </div>
            </div>
        </div>
    </div>
@endsection
