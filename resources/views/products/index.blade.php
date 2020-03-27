@extends('layout')

@section('navigation')
    <li class="breadcrumb-item active">Produkty</li>
@endsection

@section('main')
    <h1 class="mt-5 mb-2">Správa produktů</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 mb-5">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Přidat nový produkt</a>
                <a href="{{ route('categories.create') }}" class="btn btn-dark">Přidat novou kategorii</a>
                <a href="{{ route('types.create') }}" class="btn btn-dark">Přidat nový typ produtků</a>
            </div>
        </div>
        @forelse($products as $product)
            <div class="col-sm-3">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ $product->imageUrl }}" alt="{{ $product->name }}"/>
                    <div class="card-body">
                        <span class="badge badge-primary mr-2">{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</span>
                        {{ $product->name }}
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-block btn-primary">Zobrazit</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-12">
                <h4>V databázi nejsou žádné produkty</h4>
            </div>
        @endforelse
    </div>
@endsection
