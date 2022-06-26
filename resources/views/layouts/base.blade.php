<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <title>{{ 'WeFashion' }}</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light  p-0">
        <div class="container-fluid ">
            <a class="navbar-brand" href="{{ route('products') }}">WE FASHION</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse h-full p-3 " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link discount link {{ request()->routeIs('products.discount') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('products.discount') }}">Soldes</a>
                    </li>
                    @foreach (App\Models\Category::all() as $category)
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->is('category/' . $category->name) ? 'active' : '' }}"
                                href="{{ route('products.category', ['name' => $category->name]) }}">{{ $category->name }}</a>
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
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="single_footer">
                            <h4>Servicess client</h4>
                            <ul>
                                <li><a href="#">Contanctez-nous</a></li>
                                <li><a href="#">Livraison & Retour</a></li>
                                <li><a href="#">Condition de vente</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single_footer single_footer_address">
                            <h4>Informations</h4>
                            <ul>
                                <li><a href="#">Mentions légales</a></li>
                                <li><a href="#">Presse</a></li>
                                <li><a href="#">Fabrication </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single_footer single_footer_address">
                            <h4>Suivez-nous !</h4>
                            <div class="signup_form">
                                <form action="#" class="subscribe">
                                    <input type="text" class="subscribe__input" placeholder="Entrez-votre E-mail">
                                    <button type="button" class="subscribe__btn"><i
                                            class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="social_profile">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/1c6875637a.js" crossorigin="anonymous"></script>


</body>

</html>
