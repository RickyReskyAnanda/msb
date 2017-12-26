<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Dec 2015 00:55:18 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-RKPD | KABUPATEN YALIMO</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

     <!-- Data Tables -->
    <link href="{{asset('assets/css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/dataTables/dataTables.tableTools.min.css')}}" rel="stylesheet">

    <script src="{{asset('assets/js/jquery-2.1.1.js')}}"></script>

</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header" style="background:url('{{asset('images/logo1.png')}}');    height: 156px; ">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs" > <strong class="font-bold" style="color:#fff">{{strtoupper(Auth::user()->name)}}</strong>
                                 </span> <span class="text-muted text-xs block" style="color:#fff">{{Auth::user()->level}} <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{url('rkpd/administrator/profil')}}">Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('logout/rkpd')}}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            RKPD
                        </div>
                    </li>
                    <li class="active">
                        <a href="{{url('rkpd/administrator')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Beranda</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/review-renstra')}}"><i class="fa fa-database"></i> <span class="nav-label">Review Renstra</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/review-musrenbang')}}"><i class="fa fa-files-o"></i> <span class="nav-label">Review Musrenbang</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/input-rkpd/manual_rkpd')}}"><i class="fa fa-files-o"></i> <span class="nav-label">Input RKPD</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/review-rkpd')}}"><i class="fa fa-files-o"></i> <span class="nav-label">Review RKPD</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/anggaran-perubahan')}}"><i class="fa fa-files-o"></i> <span class="nav-label">Anggaran Perubahan</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/laporan-rkpd')}}"><i class="fa fa-file-excel-o"></i> <span class="nav-label">Laporan RKPD</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/laporan-renja')}}"><i class="fa fa-database"></i> <span class="nav-label">Laporan Renja</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('rkpd/administrator/user')}}"><i class="fa fa-users"></i> <span class="nav-label">Master User</span></a>
                    </li>

                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:;"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message"><b>E-RKPD BAPPEDA KABUPATEN YALIMO</b></span>
                        </li>   
                        <li>
                        <a href="{{url('logout/rkpd')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @yield('content')
    </div>



    <!-- Mainly scripts -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>


    <!-- Data Tables -->
    <script src="{{asset('assets/js/plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dataTables/dataTables.responsive.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dataTables/dataTables.tableTools.min.js')}}"></script>


    <!-- Custom and plugin javascript -->
    <script src="{{asset('assets/js/inspinia.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pace/pace.min.js')}}"></script>

    <!-- iCheck -->
    <script src="{{asset('assets/js/plugins/iCheck/icheck.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataTables-example').DataTable();
        });

    </script>
</body>

</html>
