@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('types.index') }}">
            Správa typů produktů
        </a>
    </li>
    <li class="breadcrumb-item">Přidat nový typ</li>
@endsection

@section('main')
    <h1 class="mb-2 mt-5">Přidat nový typ produktu</h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('types.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Jméno typu</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="category">Přidat do kategorie</label>
                            <select type="text" name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-block btn-primary">Přidat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
