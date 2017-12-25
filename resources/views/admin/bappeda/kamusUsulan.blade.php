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
    <div class="panel panel-red">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah, Ubah & Hapus Kamus Usulan</h3>
        </div>
        <div class="panel-body">
            <a href="" class="btn btn-success">+ Usulan Fisik</a>&emsp;
            <a href="" class="btn btn-primary">+ Usulan Non Fisik</a><br><br>

            <form role="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" name="pencarian" id="pencarian" >
                <div class="form-group input-group">
                    <select class="form-control" name="search" id="search">
                        <option value="fisik">Usulan Fisik</option>
                        <option value="nonfisik">Usulan Non Fisik</option>
                    </select> 
                    <span class="input-group-btn"><button class="btn btn-default" type="submit" name="submit" id="submit"><i class="fa fa-search"></i></button></span>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Usulan</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>SKPD Pelaksana</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="5">
                        
                            </th><th>Total :<b> 123 </b></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection