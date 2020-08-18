<!DOCTYPE html>
<html lang="pt-br">
<head>
 
    <title>Loja virtual - @yield('pagina_titulo')</title>

    <!-- Import Google Icon Font -->
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Import materialize.css -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link href="/css/style.css" rel="stylesheet">-->

</head>
<body>
    
    <header>
        <nav>
            <div class="nav-wrapper light-blue row">
                <a href="/" class="brand-logo col offset-l1">
                    Loja Virtual
                </a>
                <a href="#" data-activates="mobile-menu" class="button-collapse">
                    <i class="material-cons">
                        menu
                    </i>
                </a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="{{ route('carrinho.index') }}">Carrinho</a>
                    </li>
                    @if(Auth::guest())
                        <li><a href="{{ url('/login') }}">Entrar</a></li>
                        <li><a href="{{ url('/register') }}">Cadastere-se</a></li>
                        
                    @else 
                        <li>
                            <a class="dropdown-button" href="#!" data-activities="dropdown-user">
                                Olá {{ Auth::user()->name }} ! <i class="material-icons right">arrow_drop_down</i>
                            </a>
                                
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Sair
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
    <main>
        @yield('pagina_conteudo')

        @if(!Auth::guest())
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hide">
                {{ csrf_field() }}
            </form>
        @endif
    </main>
    <footer class="page-footer blue">
        <div class="footer-copyright">
            <div class="container">
                Desenvolvido para Curso de carrinho de compras com laravel
            </div>
        </div>
    </footer>

    <!-- Import Jquery before materialize.js-->
    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    @stack('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".button-collapse").sideNav();
            $("select").material_select();
        })
    </script>
</body>
</html>