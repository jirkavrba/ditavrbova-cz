@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}">
            Správa kategorií produktů
        </a>
    </li>
    <li class="breadcrumb-item">Přidat novou kategorii</li>
@endsection

@section('main')
    <h1 class="mb-2 mt-5">Přidat novou kategorii</h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Jméno kategorie</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <button class="btn btn-block btn-primary">Přidat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
