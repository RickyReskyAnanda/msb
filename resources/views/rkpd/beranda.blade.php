@extends('rkpd.index')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> Selamat Datang Tim
                </div>
                <div class="panel-body">
                    <p>Anda masuk sebagai {{ucfirst(Auth::user()->level)}}.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div>
            <strong>Copyright</strong> BAPPEDA KABUPATEN YALIMO
        </div>
    </div>

</div>
@endsection