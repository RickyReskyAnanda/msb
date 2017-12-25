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
                <h5 class="breadcrumbs-title">Usulan</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('/desa')}}">Beranda</a></li>
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
                                                <div class="card green lighten-4">
                                                    <div class="card-content">

                                                        <b>Level Usulan:</b><br>{{$val->level}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="card green lighten-4">
                                                    <div class="card-content">
                                                        <h5>{{$val->nm_pekerjaan}}</h5>
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
                                                @foreach($val->foto as $foto)
                                                <div class="card ">
                                                    <div class="card-image">
                                                        <img src="{{asset('images/usulan/thumb/'.$foto->file_foto)}}" width="200px" class="responsive-img">
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
                                                @if($val->sts_usulan == 'Proses')
                                                <div class="card ">
                                                    <div class="card-content">
                                                        <a href="{{url('desa/usulan/kirim/'.$val->id_usul_desa)}}" class="green-text darken-4-text" style="text-decoration: underline;">
                                                            <strong><i class="mdi-content-content-copy tiny"></i>Kirim ke SKPD</strong>
                                                        </a><br><br>
                                                        <a href="{{url('desa/usulan/edit/'.$val->id_usul_desa)}}" class="orange-text darken-4-text" style="text-decoration: underline;">
                                                            <strong><i class="mdi-content-create"></i>Edit Usulan</strong>
                                                        </a><br><br>
                                                        <a href="{{url('desa/usulan/hapus/'.$val->id_usul_desa)}}" class="red-text darken-4-text" style="text-decoration: underline;">
                                                            <strong><i class="mdi-content-clear tiny"></i>Hapus</strong>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>

                                       
                                        @endforeach
                                        @endif
                                        <!-- untuk 1 record -->
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