<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

    <!-- Dropdown 1 Structure -->
    <ul id='dropdown1' class='dropdown-content'>
        @foreach ($categoriasMenu as $categoriaM)
            <li><a href="{{ route('site.categoria', $categoriaM)}}">{{ $categoriaM->nome }}</a></li>
        @endforeach
    </ul>

    <!-- Dropdown 2 Structure -->
    <ul id='dropdown2' class='dropdown-content'>

        <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
        <li><a href="{{ route('login.logout')}}">Sair</a></li>

    </ul>

    <nav class="#880e4f pink darken-4">
        <div class="nav-wrapper container">
          <a href="#" class="brand-logo center">DigitalProductStore</a>
          <ul id="nav-mobile" class="left">
            <li><a href="{{ route('site.index') }}">Home</a></li>
            <li><a href="" class="dropdown-trigger" data-target='dropdown1'> Categorias <i class="material-icons right">expand_more</i> </a></li>
            {{-- o span irá adcionar um pequeno bloco ao lado do menu carrinho, p/ dentro dele será exibido a qnt de itens do carrinho --}}
            <li><a href="{{ route('site.carrinho') }}">Carrinho <span class="new badge #e040fb purple accent-2" data-badge-caption="" style="color: white; font-weight: 700;">{{ \Cart::getContent()->count() }}</span></a></li>
          </ul>

          {{-- O conteudo só será mostrado se o user estiver autenticado --}}
          @auth
            {{-- Se o user estiver logado é posivel recuperar as info sobre ele pelo method auth(recebendo os dados sobre o user no LoginController ) --}}
            <ul id="nav-mobile" class="right">
                <li><a href="" class="dropdown-trigger" data-target='dropdown2'>Olá {{ auth()->user()->firstName }}<i class="material-icons right">expand_more</i> </a></li>
            </ul>
          @else
            <ul id="nav-mobile" class="right">
                <li><a href="{{ route('login.form') }}">Login<i class="material-icons right">lock</i> </a></li>
            </ul>
          @endauth

        </div>
    </nav>

    @yield('conteudo')

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        // inicializa todos os componentes do materialize
        // M.AutoInit();
        /* Dropdown */
        var elemDrop = document.querySelectorAll('.dropdown-trigger');
        var instanceDrop = M.Dropdown.init(elemDrop, {
            coverTrigger: false,
            constrainWidth: false
        });

    </script>

</body>
</html>

