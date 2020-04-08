@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('products.index') }}">Produkty</a>
    </li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection

@section('main')
    <div class="mt-5 mb-2">
        <h1>Produkt {{ $product->name }}</h1>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-2 mb-5">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Upravit produkt</a>
                    <a href="{{ route('additional-images.create', $product) }}" class="btn btn-dark">Nastavení
                        doplňujících obrázků</a>
                    <a href="{{ route('products.visibility', $product) }}" class="btn btn-dark">
                        @if ($product->visible)
                            Skrýt produkt
                        @else
                            Zobrazit produkt
                        @endif
                    </a>
                    <div class="float-right">
                        <form action="{{ route('products.destroy', $product) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Smazat produkt {{ $product->name }}?')">Smazat produkt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img src="{{ $product->imageUrl }}" class="card-img-top"
                    @unless($product->visible) style="opacity: 0.5;" @endunless>
                <div class="card-body">
                    @forelse($product->additionalImages as $image)
                        <img src="{{ $image->url }}" style="width: 80px; height: 80px; margin-right: 10px; margin-bottom: 10px;">
                    @empty
                        <b class="text-center">Tento produkt nemá žádné doplňující obrázky</b>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <small>Preferenční koeficient</small>
                            <p>{!! str_repeat('&bigstar;', $product->preference) !!}</p>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <small>Kategorie</small>
                                    <p>{{ optional($product->category)->name ?? "Error" }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <small>Typ</small>
                                    <p>{{ optional($product->type)->name ?? "Error" }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <small>Dostupnost</small>
                            @if ($product->in_stock)
                                <p class="text-success">Skladem</p>
                            @else
                                <p>Na objednávku</p>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <small>Popis</small>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <small>Specifikace</small>
                            <p>{{ $product->specifications }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <small>Osobní poznámka</small>
                            <form action="{{ route('products.note', $product) }}" method="post">
                                @csrf
                                <div class="form-group mt-2">
                                    <textarea name="note" class="form-control">{{ $product->personal_note }}</textarea>
                                </div>
                                <button class="btn btn-primary">Uložit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
