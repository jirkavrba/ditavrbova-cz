@extends('layout')

@push('styles')
    <style>
        #login {
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        #login .card {
            width: 50%;
        }
    </style>
@endpush
@section('navigation')
    <li class="breadcrumb-item active">Přihlášení</li>
@endsection
@section('main')
    <div id="login">
        <div class="card @if($errors->any()) animated shake @endif">
            <div class="card-header">
                <h3 class="card-title">Přihlášení do administrace</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('authentication.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">Uživatelské jméno</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Heslo</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <hr>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary">Pokračovat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
