@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">Správa kategorií produktů</li>
@endsection

@section('main')
    <h1 class="mb-2 mt-5">Kategorie produktů</h1>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 mb-5">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Přidat novou kategorii</a>
                <a href="{{ route('types.create') }}" class="btn btn-dark">Přidat nový typ produtků</a>
            </div>
        </div>
        @foreach($categories as $category)
            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-body">
                        {{ $category->name }}
                    </div>
                    <div class="card-footer">
                        <a  href="{{ route('categories.edit', $category) }}" class="btn btn-block btn-primary">Upravit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
