<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand"  href="{{route('products')}}">WeFashion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <li class="nav-item active">
                     <a class="nav-link " aria-current="page" href="{{route('products.discount')}}">Soldes</a>
                   </li>
                  @foreach (App\Models\Category::all() as $category)
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('products.category', ['name' => $category->name]) }}">{{ $category->name }}</a>
                   </li>
                  @endforeach
                  
                </ul>
                <ul class="navbar-nav ml-auto">
                    @if (Auth::user())
                    @if ( Auth::user()->role === 'ADMIN')
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href={{route('dashboard')}}>Espace admin</a>
                    </li>  
                    @endif
                        <li class="nav-item">
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="btn">Déconnexion</button>
                        </form>
                    </li> 
                    @else
                        <li class="nav-item active">
                     <a class="nav-link " aria-current="page" href={{route('login')}}>Me connecter</a>
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
