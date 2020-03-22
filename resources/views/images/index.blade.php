@extends('layout')

@section('navigation')
    <li class="breadcrumb-item active">Správa obrázků</li>
@endsection

@section('main')
    <h1 class="mt-5 mb-2">Správa obrázků</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 mb-5">
                <a href="{{ route('images.create') }}" class="btn btn-primary">Nahrát obrázky</a>
            </div>
        </div>
        @foreach ($images as $image)
            <div class="col-sm-3">
                <div class="card mb-4">
                    <img src="{{ $image->url }}" alt="{{ $image->path }}" class="card-img-top">
                    <div class="card-footer">
                        <form action="{{ route('images.destroy', $image) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-block btn-danger"
                                    onclick="return confirm('Smazat tento obrázek? Tato akce smaže i všechny databázové asociace s ním.')"
                            >Smazat obrázek</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
