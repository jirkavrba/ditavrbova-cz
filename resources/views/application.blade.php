<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <h1>Výpis kategorií</h1>
    <ol>
        @foreach($categories as $category)
            <li>
                <h2>{{ $category->name }}</h2>
                <ol>
                    @foreach($category->types as $type)
                        <li>{{ $type->name }}</li>
                    @endforeach
                </ol>
            </li>
        @endforeach
    </ol>
    <h1>Výpis produktů</h1>
    <ol>
        @foreach($products as $product)
            <li>
                <h2>{{ $product->name }}</h2>
                <img src="{{ $product->imageUrl }}" style="width: 100px; height: 100px;">
            </li>
        @endforeach
    </ol>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
