
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Dec 2015 00:55:09 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | e-RKPD Kabupaten Yalimo</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <div class="ibox-content">
                    <h1 class="text-center">E-RKPD</h1>
                    <form class="m-t" method="post" role="form" action="{{url('rkpd/login')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" name="username" minlength="6" maxlength="32" class="form-control" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" minlength="6" maxlength="32" class="form-control" placeholder="Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                Copyright Bappeda Kabupaten Yalimo
            </div>
        </div>
    </div>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Dec 2015 00:55:09 GMT -->
</html>
