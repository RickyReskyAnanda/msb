<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>E-MUSRENBANG | KABUPATEN YALIMO</title>

  <!-- Favicons-->
  <link rel="icon" href="{{asset('images/favicon/favicon-32x32.png')}}" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="{{asset('administrators/images/favicon/mstile-144x144.png')}}">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="{{asset('administrators/css/materialize.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('administrators/css/style.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="{{asset('administrators/css/custom/custom.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{asset('administrators/js/plugins/prism/prism.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('administrators/js/plugins/perfect-scrollbar/perfect-scrollbar.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('administrators/js/plugins/data-tables/css/jquery.dataTables.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
    <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
 
  </style>

  <!-- jQuery Library -->
  <script type="text/javascript" src="{{asset('administrators/js/plugins/jquery-1.11.2.min.js')}}"></script>    
  <script type="text/javascript" src="{{asset('administrators/js/materialize.min.js')}}"></script>


</head>

<body>
  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1">E-MUSRENBANG KABUPATEN YALIMO</a> <span class="logo-text">Materialize</span></h1></li>
                    </ul>
                    <!-- <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize"/>
                    </div> -->
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
          <li class="user-details cyan darken-2" style="background: url({{asset('images/logo.png')}}) no-repeat center center;min-height: 147px;">
          @if(!auth()->guest())
            <div class="row">
                <div class= "col s12">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li>
                          <a href="{{url('akun')}}"><i class="mdi-action-face-unlock"></i> Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a href="{{url('logout')}}"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">{{ucwords(Auth::user()->name)}}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php if(Auth::user()->level=='desa') echo 'Kampung'; else echo ucwords(Auth::user()->level);?></p>
                </div>
            </div>
          @endif
          </li>
        @if(isset(Auth::user()->level))
          @if(Auth::user()->level=='administrator' || Auth::user()->level=='bappeda')
            @include('admin.admin.menu')
          @elseif(Auth::user()->level=='dprd')
            @include('admin.dprd.menu')
          @elseif(Auth::user()->level=='skpd')
            @include('admin.skpd.menu')
          @elseif(Auth::user()->level=='distrik')
            @include('admin.distrik.menu')
          @elseif(Auth::user()->level=='desa')
            @include('admin.desa.menu')
          @endif
        @else
          @include('admin.guest.menu')
        @endif
        </ul>
      </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">
        
        @yield('content')
      </section>
      <!-- END CONTENT -->

      

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>2017 © BAPPEDA KABUPATEN YALIMO</span>
        </div>
    </div>
  </footer>
  <!-- END FOOTER -->


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!--materialize js-->
    <!--prism
    <script type="text/javascript" src="{{asset('administrators/js/prism/prism.js')}}"></script>-->
    <!--scrollbar-->
    <script type="text/javascript" src="{{asset('administrators/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <!-- data-tables -->
    <script type="text/javascript" src="{{asset('administrators/js/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#data-table-simple').DataTable();
        $('#data-table-simple2').DataTable();
      });

    </script>
     <!-- chartist -->
    <!-- validation -->
    <script type="text/javascript" src="{{asset('administrators/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    @if(isset(Auth::user()->level))
      @if(Auth::user()->level=='administrator' || Auth::user()->level=='administrator')
        <script type="text/javascript" src="{{asset('administrators/js/validation/admin-validation.js')}}"></script>
        
      @elseif(Auth::user()->level=='dprd')
        <script type="text/javascript" src="{{asset('administrators/js/validation/admin-validation.js')}}"></script>
      @elseif(Auth::user()->level=='skpd')
        <script type="text/javascript" src="{{asset('administrators/js/validation/skpd-validation.js')}}"></script>
      @elseif(Auth::user()->level=='distrik')
        <script type="text/javascript" src="{{asset('administrators/js/validation/distrik-validation.js')}}"></script>
      @elseif(Auth::user()->level=='desa')
        <script type="text/javascript" src="{{asset('administrators/js/validation/desa-validation.js')}}"></script>
      @endif
    @else
        <script type="text/javascript" src="{{asset('administrators/js/validation/guest-validation.js')}}"></script>
    @endif

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{asset('administrators/js/plugins.min.js')}}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{asset('administrators/js/custom-script.js')}}"></script>
      
</body>

</html>