<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrace | Dita Vrbová</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="container">
        <div class="navbar-brand">
            <a href="{{ route('administration.index') }}" class="text-white">Administrace</a>
        </div>
        <ul class="ml-auto navbar-nav">
            @auth
                <li class="nav-item">
                    <a href="{{ route('application') }}" class="nav-link">Přepnout na stránku</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('authentication.logout') }}" class="nav-link">Odhlásit se</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<header class="bg-transparent">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('administration.index') }}">Administrace</a></li>
                @yield('navigation')
            </ol>
        </nav>
    </div>
</header>

<main class="mt-3">
    <div class="container">
        @yield('main')
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
