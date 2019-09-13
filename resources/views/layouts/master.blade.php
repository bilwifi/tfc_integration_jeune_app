<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Bil Wifi" content="{{ config('app.name') }} by KinDev">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('favicon.ico') }}>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty ($title) ? $title .' | '. config('app.name') : config('app.name') }}  </title>

    @yield('stylesheet1')
        <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/icons/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
    <style type="text/css">
        .card{
            border-radius: 10px ;
        }
        .card .card-header{
            /*border-radius: 10px ;*/
        }
        .scroll-panel{
            position: relative;
            overflow-y: scroll;
        }
        .offres-panel{

        }
    </style>
     {{-- <link href="{{ asset('dataTables/dataTables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('dataTables/buttons/css/buttons.dataTables.min.css') }}" rel="stylesheet"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Custom styles for this template -->
    <style type="text/css">
      html,
      body {
        overflow-x: hidden; /* Prevent scroll on narrow devices */
      }

      body {
        padding-top: 56px;
      }

      @media (max-width: 991.98px) {
        .offcanvas-collapse {
          position: fixed;
          top: 56px; /* Height of navbar */
          bottom: 0;
          left: 100%;
          width: 100%;
          padding-right: 1rem;
          padding-left: 1rem;
          overflow-y: auto;
          visibility: hidden;
          background-color: #343a40;
          transition-timing-function: ease-in-out;
          transition-duration: .3s;
          transition-property: left, visibility;
        }
        .offcanvas-collapse.open {
          left: 0;
          visibility: visible;
        }
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        color: rgba(255, 255, 255, .75);
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .nav-underline .nav-link {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: .875rem;
        color: #6c757d;
      }

      .nav-underline .nav-link:hover {
        color: #007bff;
      }

      .nav-underline .active {
        font-weight: 500;
        color: #343a40;
      }

      .text-white-50 { color: rgba(255, 255, 255, .5); }

      .bg-purple { background-color: #6f42c1; }

      .lh-100 { line-height: 1; }
      .lh-125 { line-height: 1.25; }
      .lh-150 { line-height: 1.5; }
    </style>
    @stack('stylesheets')
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-danger">
      <a class="navbar-brand mr-auto mr-lg-0 btn btn-outline-default" href="#">SFI</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse mr-auto" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        
        </ul>
        <div class="my">
          @if (auth('web')->check())
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('home') }}">Acceuil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Notifications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profil_user') }}">Profile</a>
            </li>
           
            <li class="nav-item dropleft">
              <a class="nav-link dropdown-toggle" href="https://example.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ img_profil(auth()->user()->idusers) }}" class="img-fluid rounded-circle" alt="Bil" width="25 " height="25"></a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                 <a class="dropdown-item"  href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  Déconnexion
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
          </form>
              
              </div>
            </li>
          </ul> 
          
          @elseif(auth('admin')->check())
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('admin.index') }}">Acceuil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Notifications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li>
           
            <li class="nav-item dropleft">
              <a class="nav-link dropdown-toggle" href="https://example.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ img_profil(auth()->user()->idusers) }}" class="img-fluid rounded-circle" alt="Bil" width="25 " height="25"></a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                 <a class="dropdown-item"  href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  Déconnexion
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
          </form>
              
              </div>
            </li>
          </ul> 
          @else
          <form class="form-inline my-2 my-lg-0" action="{{ route('login') }}" method="POST">
            @csrf
            <input class="form-control mr-sm-2" type="text" placeholder="pseudo" aria-label="pseudo" name="pseudo" required="">
            <input class="form-control mr-sm-2" type="password" placeholder="password" aria-label="password" name="password" required="">
            <button class="btn btn-outline-default my-2 my-sm-0" type="submit">Se connecter</button>
          </form>
          @endauth
        </div>
      </div>
    </nav>


    <main role="main" class="container-fluide" style="margin: 2%">
        {{-- <h6 class="border-bottom border-gray pb-2 mb-0">Palmarès</h6> --}}
        @yield('content')       

       {{--  @auth
        <small class="d-block text-right mt-3">
          
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              Déconnexion
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </small>
        @else
          <small class="d-block text-right mt-3">
          <a href="{{ route('login') }}">Connexion</a>
        </small>
        @endauth --}}
    </main>
    <footer class=" bg-danger text-white ">
      <div class="container justify-content-center text-center">
        <span class="text-center">&copy ISPT - KIN</span>
      </div>
    </footer>

    <script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- <script src="dist/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="dist/js/jquery-ui.min.js"></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
     {{-- <script type="text/javascript" src="{{ asset('dataTables/datatables.min.js') }}"></script> --}}
     @stack('scripts')
    @include('flashy::message')
     
  </body>

<!-- Mirrored from getbootstrap.com/docs/4.1/examples/floating-labels/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:42:06 GMT -->
</html>
  