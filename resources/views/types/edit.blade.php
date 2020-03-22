@extends('layout')

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('types.index') }}">
            Správa typů produktů
        </a>
    </li>
    <li class="breadcrumb-item">Upravit typ {{ $type->name }}</li>
@endsection

@section('main')
    <h1 class="mb-2 mt-5">Upravit typ produktu {{ $type->name }}</h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('types.update', $type) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Jméno typu</label>
                            <input type="text" name="name" id="name" value="{{ $type->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="category">Přesunout do kategorie</label>
                            <select type="text" name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ $type->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-block btn-primary">Uložit</button>
                    </form>
                </div>
            </div>
        </div>
        @unless($types->count() === 1)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('types.destroy', $type) }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="form-group">
                                <label for="type">Smazat typ a všechny jeho produkty přesunout pod typ</label>
                                <select type="text" name="type" id="type" class="form-control">
                                    @foreach ($types as $_type)
                                        @if ($_type->id !== $type->id)
                                            <option value="{{ $_type->id }}">{{ $_type->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-block btn-danger" onclick="return confirm('Smazat tento typ?');">Smazat</button>
                        </form>
                    </div>
                </div>
            </div>
        @endunless
    </div>
@endsection
