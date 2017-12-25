@extends('admin.index')

@section('content')
<style type="text/css">
    th,td{
        border-radius: 0px;
        vertical-align: top;
        padding: 0px 5px;
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
                <h5 class="breadcrumbs-title">Aspirasi Masyarakat</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li class="active">Aspirasi Masyarakat</li>
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
                
                <div class="card">
                    <div class="card-content">
                        <h6>FILTER USULAN</h6>
                        <form class="col s12 formValidate" id="formaspirasi" method="get" action="{{url('administrator/aspirasi-masyarakat')}}">

                            <div class="row">
                                <div class="col s5">
                                    <label for="desa">Pilih Distrik dan Desa</label>
                                    <select class="error browser-default" id="desa" name="desa" data-error=".errorTxt1">
                                        <option value="" disabled selected>Pilih Distrik dan Desa</option>
                                        @foreach($distrik as $dist)
                                        <optgroup label="{{strtoupper($dist->nm_distrik)}}">
                                            @foreach($dist->desa as $ds)
                                                <option value="{{$ds->id_desa}}" <?php if($request->desa==$ds->id_desa)echo "selected"?>>{{strtoupper($ds->nm_desa)}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt1"></div>
                                    </div>
                                </div>
                                <div class="col s5">
                                    <label for="bidang">Pilih Bidang</label>
                                    <select class="error browser-default" id="bidang" name="bidang" data-error=".errorTxt2">
                                        <option value="" disabled selected>Pilih Bidang</option>
                                        @foreach($bidang as $bdg)
                                        <option value="{{$bdg->id_bidang}}" <?php if($request->bidang==$bdg->id_bidang)echo "selected"?>>{{ucwords($bdg->bidang)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt2"></div>
                                    </div>
                                </div>
                                <div class="input-field col s2">
                                    <button class=" btn-large orange" style="width: 100%" type="submit"><i class="mdi-action-search" style="font-size: 1.1rem;" ></i> CARI</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <table class="bordered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Biodata</th>
                                            <th>Rincian Masalah</th>
                                            <th>Rincian Solusi</th>
                                            <th>Gambar Dokumentasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($usulan)<1)
                                        <tr>
                                            <td colspan="6" class="center"><h6><strong>Hasil Pencarian Tidak Ada !</strong></h6></td>
                                        </tr>
                                        @else
                                        <?php $i=1;?>
                                        @foreach($usulan as $usul)
                                            <tr>
                                            <td>
                                                <div class="card green lighten-3">
                                                    <div class="card-content">
                                                        <b>{{$i++}}</b>
                                                    </div>
                                                </div>
                                                <div class="card amber lighten-3">
                                                    <div class="card-content">
                                                        <b>Desa: </b><br>
                                                        {{$usul->desa->nm_desa}}
                                                    </div>
                                                </div>
                                                <div class="card amber lighten-3">
                                                    <div class="card-content">
                                                        <b>Distrik: </b><br>
                                                        {{$usul->distrik->nm_distrik}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card cyan lighten-4">
                                                    <div class="card-content">
                                                        <b>Contact Person :</b><br>
                                                        <b>Nama : </b><br>{{ucwords($usul->nm_lengkap)}}<br>
                                                        <b>Alamat : </b><br>{{ucfirst($usul->alamat)}}<br>
                                                        <b>NIK : </b>{{$usul->nik}}<br>
                                                        <b>Telp : </b>{{$usul->no_telp_hp}}<br>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card blue lighten-4">
                                                    <div class="card-content">
                                                       <p>{{$usul->rincian_masalah}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card yellow lighten-4">
                                                    <div class="card-content">
                                                       <p>{{$usul->rincian_usulan}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card">
                                                    <div class="card-image">
                                                       <img width="150px" src="{{asset('images/aspirasi/thumb/'.$usul->gambar_doc)}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{url('administrator/aspirasi-masyarakat/hapus/'.$usul->id_jasmara)}}" class="btn red" style="margin-top: 10px">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
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