@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}">
            Správa kategorií produktů
        </a>
    </li>
    <li class="breadcrumb-item">Upravit kategorii {{ $category->name }}</li>
@endsection

@section('main')
    <h1 class="mb-2 mt-5">Upravit kategorii {{ $category->name }}</h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Jméno kategorie</label>
                            <input type="text" name="name" id="name" value="{{ $category->name  }}" class="form-control">
                        </div>
                        <button class="btn btn-block btn-primary">Uložit</button>
                    </form>
                </div>
            </div>
        </div>
        @unless($categories->count() === 1)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('categories.destroy', $category) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="form-group">
                                <label for="category">Smazat kategorii a všechny její typy a produkty přesunout pod kategorii</label>
                                <select type="text" name="category" id="category" class="form-control">
                                    @foreach ($categories as $_category)
                                        @if ($_category->id !== $category->id)
                                            <option value="{{ $_category->id }}">{{ $_category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-block btn-danger" onclick="return confirm('Smazat tuto kategorii?');">Smazat</button>
                        </form>
                    </div>
                </div>
            </div>
        @endunless
    </div>
@endsection
