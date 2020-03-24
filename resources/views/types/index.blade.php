@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">Správa typů produktů</li>
@endsection
@section('main')
    <h1 class="mb-2 mt-5">Typy produktů</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 mb-5">
                <a href="{{ route('types.create') }}" class="btn btn-primary">Přidat nový typ produtků</a>
                <a href="{{ route('categories.create') }}" class="btn btn-dark">Přidat novou kategorii</a>
            </div>
        </div>
        @foreach($categories as $category)
            <div class="col-sm-12">
                <div class="my-2">
                    <h4>Kategorie {{ $category->name }}</h4>
                    <div class="row">
                        @if (is_iterable($type->get($category->id)))
                            @foreach ($types->get($category->id) as $type)
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $type->name }}
                                        </div>
                                        <div class="card-footer">
                                            <a  href="{{ route('types.edit', $type) }}" class="btn btn-block btn-primary">Upravit</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
