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
                <h5 class="breadcrumbs-title">Usulan Disetujui</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li class="active">Usulan disetujui</li>
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
                <div class="card">
                    <div class="card-content">
                        <h6>FILTER USULAN</h6>
                        <form class="col s12 formValidate" id="pencarianusulan" method="get" action="{{url('administrator/usulan/ditolak')}}">

                            <div class="row">
                                <div class="col s6">
                                    <label for="skpd">Pilih SKPD</label>
                                    <select class="error browser-default" id="skpd" name="skpd" data-error=".errorTxt1">
                                        <option value="semua" selected>Semua SKPD</option>
                                        @foreach($skpd as $skp)
                                        <option value="{{$skp->id_skpd}}" <?php if($request->skpd == $skp->id_skpd) echo "selected";?>>{{$skp->nm_skpd}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt1"></div>
                                    </div>
                                </div>
                                <div class="col s3">
                                    <label for="tipe">Tipe Pekerjaan</label>
                                    <select class="error browser-default" id="tipe" name="tipe" data-error=".errorTxt2">
                                        <option value="semua" selected>Pilih Semua Tipe</option>
                                        <option value="FISIK" <?php if($request->tipe == "FISIK")echo "selected";?>>FISIK</option>
                                        <option value="NON FISIK" <?php if($request->tipe == "NON FISIK")echo "selected";?>>NON FISIK</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt2"></div>
                                    </div>
                                </div>
                                <div class="input-field col s3">
                                    <button class=" btn-large orange" type="submit"><i class="mdi-action-search right"></i>CARI</button>
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
                                            <th>Usulan</th>
                                            <th>Biaya</th>
                                            <th>Kondisi</th>
                                            <th>SKPD Pelaksana</th>
                                            <th>Foto-Foto Kondisi</th>
                                            <th>Status dan Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($usulan)<1)
                                        <tr>
                                            <td colspan="7">
                                                <h6 class="center"><strong>Data Tidak Ada !</strong></h6>
                                            </td>
                                        </tr>
                                        @else
                                            <?php $i=1;?>
                                        @foreach($usulan as $val)
                                        <!-- untuk 1 record -->
                                        <tr>
                                            <td>
                                                <div class="card green lighten-3">
                                                    <div class="card-content">
                                                        <b>{{$i++}}</b>
                                                    </div>
                                                </div>
                                                <div class="card amber lighten-3">
                                                    <div class="card-content">
                                                        <b>Kampung: </b><br>
                                                        {{$val->desa->nm_desa}}
                                                    </div>
                                                </div>
                                                <div class="card amber lighten-3">
                                                    <div class="card-content">
                                                        <b>Distrik: </b><br>
                                                        {{$val->distrik->nm_distrik}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card green lighten-4">
                                                    <div class="card-content">
                                                        <h5>{{$val->nama_pekerjaan}}</h5>
                                                    </div>
                                                </div>
                                                <div class="card green lighten-4">
                                                    <div class="card-content">
                                                        <b>Jalan : </b><br>
                                                        {{$val->jalan}}
                                                    </div>
                                                </div>
                                                <div class="card green lighten-4">
                                                    <div class="card-content">
                                                        <b>Ket : </b><br>
                                                        {{$val->keterangan}}
                                                    </div>
                                                </div>
                                                <div class="card cyan lighten-4">
                                                    <div class="card-content">
                                                        <b>Contact Person :</b><br>
                                                        {{ucwords($val->cp_nama)}}<br>
                                                        {{ucfirst($val->cp_alamat)}}<br>
                                                        <b>Telp : </b>{{$val->cp_telp}}<br>
                                                        <b>HP : </b>{{$val->cp_hp}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card yellow accent-1">
                                                    <div class="card-content">
                                                        {{$val->volume.'X'.number_format($val->harga).'/'.$val->satuan}}<br>
                                                        <b>Hasil : </b> Rp.<?=number_format($val->volume*$val->harga)?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card teal lighten-3">
                                                    <div class="card-content">
                                                        <b>Kondisi saat ini : </b><br>{{$val->faktor1}}
                                                    </div>
                                                </div>
                                                <div class="card teal lighten-3">
                                                    <div class="card-content">
                                                        <b>Tingkat Kebutuhan atau Pemakaian: </b><br>{{$val->faktor2}}
                                                    </div>
                                                </div>
                                                <div class="card teal lighten-3">
                                                    <div class="card-content">
                                                        <b>Dampak Kegiatan: </b><br>{{$val->faktor3}}
                                                    </div>
                                                </div>
                                                <div class="card amber lighten-3">
                                                    <div class="card-content">
                                                        <b>SKOR : </b>{{$val->skor}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card red lighten-4">
                                                    <div class="card-content">
                                                        <strong>{{$val->skpd_pelaksana}}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @foreach($val->fotodesa as $foto)
                                                <div class="card ">
                                                    <div class="card-image">
                                                        <img src="{{asset('images/usulan/thumb/'.$foto->file_foto)}}" width="200px">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="card yellow darken-4">
                                                  <div class="card-content white-text">
                                                    <b>Status :</b><br>
                                                    <p>{{$val->sts_usulan}}</p>
                                                  </div>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach
                                        @endif
                                        <!-- untuk 1 record -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if((!isset($request->skpd) && !isset($request->tipe)) || ($request->skpd=='semua' && $request->tipe=='semua') )
                        <div class="row" style="margin-top:15px;">
                            @if($usulan->total() > 0)
                            <div class="col l12">
                                <span>Record <?=$usulan->firstItem().'-'.$usulan->lastItem().' from '.$usulan->lastPage()?> page</span>
                            </div>
                            @endif
                            @if($usulan->total() > 10)
                            <div class="col l12 center">
                                <a class="btn cyan waves-effect waves-light" href="{{$usulan->previousPageUrl()}}">Sebelumnya</a>
                                <a class="btn cyan waves-effect waves-light" href="{{$usulan->nextPageUrl()}}">Selanjutnya</a>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end container-->
@endsection