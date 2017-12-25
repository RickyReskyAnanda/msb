@extends('admin.index')

@section('content')
<style type="text/css">
    th,td{
        border-radius: 0px;
        border: 2px solid #fff;
    }
</style>
<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey hide-on-large-only">
        <i class="mdi-action-search active"></i>
        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Usulan</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('/distrik')}}">Beranda</a></li>
                    <li class="active">Usulan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                @if (session('pesan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-navigation-check"></i> SUCCESS : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                
                <div class="row">
                    <div class="col s6">
                        <div class="card">
                            <div class="card-content">
                                <h4 class="header">Usulan Fisik</h4>
                                <table class="responsive-table display" cellspacing="0">
                                    <thead>
                                        <th>No</th>
                                        <th>Usulan</th>
                                        <th>Platform Anggaran</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($data as $val)
                                        @if($val->tipe_keg == 'FISIK')
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->nama_pekerjaan}}</td>
                                            <td>Rp.{{number_format($val->harga_satuan)}}</td>
                                            <td>/{{$val->satuan}}</td>
                                            <td>
                                                <a href="{{url('distrik/usulan/input/'.$val->id_pekerjaan)}}" class="btn cyan waves-effect waves-light">Pilih
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="card">
                            <div class="card-content">
                                <h4 class="header">Usulan Non Fisik</h4>
                                <table class="responsive-table display" cellspacing="0">
                                    <thead>
                                        <th>No</th>
                                        <th>Usulan</th>
                                        <th>Platform Anggaran</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($data as $val)
                                        @if($val->tipe_keg == 'NON FISIK')
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->nama_pekerjaan}}</td>
                                            <td>Rp{{number_format($val->harga_satuan)}}</td>
                                            <td>/{{$val->satuan}}</td>
                                            <td>
                                                <a href="{{url('distrik/usulan/input/'.$val->id_pekerjaan)}}" class="btn cyan waves-effect waves-light">Pilih
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end container-->
@endsection