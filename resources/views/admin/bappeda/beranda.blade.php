@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Tim Bapeda 
            </li>
        </ol>
    </div>
</div>
<div class="col-sm-12">
    <div class="panel panel-green">
        <div class="panel-heading">
            <h3 class="panel-title">Selamat datang Tim</h3>
        </div>
        <div class="panel-body">
            <p>Anda masuk sebagai user Bapeda.<br><br> 
            Disini Anda dapat berhak menambah, mengubah, dan menghapus Kamus Usulan. Anda juga berkewajiban memanajemen Login untuk Kecamatan, SKPD, dan Bappeda.</p>
        </div>
    </div>
</div>
@endsection