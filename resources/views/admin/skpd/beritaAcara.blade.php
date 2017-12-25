@extends('admin.index')

@section('content')
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
                <h5 class="breadcrumbs-title">Berita Acara</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('skpd')}}">Beranda</a></li>
                    <li class="active">Berita Acara</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<!--start container-->
<div class="container">
    <div class="section">
        <!--Form Advance-->          
        <div class="row">
            <div class="col s12 m12 l12">
                @if (session('pesan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-alert-success"></i> SUCCESS : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif


                
                <div class="card">
                    <div class="card-content">
                        <h6><strong>Berita Acara</strong></h6>
                        <form class="col s12 formValidate" id="inputba" name="formdata" method="post" action="{{url('skpd/berita-acara')}}">
                            {{csrf_field()}}
                            @if(isset($ba->id_ba))
                            <input type="hidden" name="id_ba" value="{{$ba->id_ba}}">
                            @endif
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="no_ba">Nomor</label>
                                    <input type="text" name="no_ba" id="no_ba" value="<?php if(isset($ba->no_ba)) echo $ba->no_ba;?>" placeholder="Masukkan Nomor Berita Acara" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="tgl_ba">Tanggal Berita Acara</label>
                                    <input type="text" name="tgl_ba" id="tgl_ba" value="<?php if(isset($ba->tgl_ba)) echo $ba->tgl_ba;?>" placeholder="ex. 17 Agustus 2017" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="pemateri_lain">Pemateri Lain</label>
                                    <input type="text" name="pemateri_lain" id="pemateri_lain" value="<?php if(isset($ba->pemateri_lain)) echo $ba->pemateri_lain;?>" placeholder="Masukkan Nama Pemateri" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="pemateri_lain">Pimpinan Sidang</label>
                                    <input type="text" name="pimpinan_sidang" id="pimpinan_sidang" value="<?php if(isset($ba->pimpinan_sidang)) echo $ba->pimpinan_sidang;?>" data-error=".errorTxt4" placeholder="Masukkan Nama Pimpinan Sidang">
                                    <div class="errorTxt4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m4">
                                    <label for="hari">Hari</label>
                                    <select class="error browser-default" name="hari" id="hari" data-error=".errorTxt5">
                                        <option value="" disabled selected>Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt5"></div>
                                    </div>
                                </div>
                                <div class="input-field col m4">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" name="tanggal" id="tanggal" value="<?php if(isset($ba->tgl)) echo $ba->tgl;?>" placeholder="Ex. 17 Agustus 2017" data-error=".errorTxt6">
                                    <div class="errorTxt6"></div>
                                </div>
                                <div class="input-field col m4">
                                    <label for="waktu">Waktu</label>
                                    <input placeholder="Ex. 12:45" id="waktu"  name="waktu" type="text" value="<?php if(isset($ba->pukul)) echo $ba->pukul;?>" data-error=".errorTxt7">
                                    <div class="errorTxt7"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" name="tempat" id="tempat" value="<?php if(isset($ba->tempat)) echo $ba->tempat;?>" data-error=".errorTxt8" placeholder="Masukkan Nama Tempat">
                                    <div class="errorTxt8"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn orange right" style="margin:10px">Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end container-->
@endsection