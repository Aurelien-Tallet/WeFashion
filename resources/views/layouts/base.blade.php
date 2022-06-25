<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <title>{{'WeFashion' }}</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light  p-0">
        <div class="container-fluid ">
            <a class="navbar-brand" href="{{ route('products') }}">WeFashion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse h-full p-3 " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link link {{request()->routeIs('products.discount' ) ? 'active' : ''}}" aria-current="page" href="{{ route('products.discount') }}">Soldes</a>
                    </li>
                    @foreach (App\Models\Category::all() as $category)
                        <li class="nav-item active">
                            <a class="nav-link {{request()->is('category/' . $category->name) ? 'active' : ''}}"
                                href="{{ route('products.category', ['name' => $category->name]) }}" >{{ $category->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <ul class="navbar-nav ml-auto">
                    @if (Auth::user())
                        @if (Auth::user()->role === 'ADMIN')
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href={{ route('admin') }}>Espace admin</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn">Déconnexion</button>
                            </form>
                        </li>
                       
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <footer>
        <h3>FOOTER</h3>
    </footer>
</body>

</html>
