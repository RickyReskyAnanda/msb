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
                <h5 class="breadcrumbs-title">Aspirasi Masyarakat</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('desa')}}">Beranda</a></li>
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
        <!--Form Advance-->          
        <div class="row">
            <div class="col s12 m12 l12">
                @if (session('pesan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-alert-warning"></i> Success : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                <form class="formValidate" id="formaspirasi" method="post" action="{{url('aspirasi-masyarakat')}}" enctype="multipart/form-data">
                    <div class="card cyan lighten-2">
                        <div class="card-content">
                                <p><b>Forum Aspirasi Masyarakat</b> ini disediakan media agar masyarakat bisa mengumpulkan kegiatan kepada tiap-tiap penanggungjawab yang memiliki bidang urusan terkait. Dengan menggunakan fasilitas ini maka diharapkan dapat menampung usulan-usulan kegiatan yang bermanfaat dan membanguns</p>
                        </div>
                    </div>
                    {{csrf_field()}}
                    <div class="card">
                        <div class="card-content">

                            <h5><strong>Biodata</strong></h5>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_nik">NIK</label>
                                    <input type="text" name="cp_nik" id="cp_nik" placeholder="Masukkan NIK" data-error=".errorTxt11">
                                    <div class="errorTxt11"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_nama">Nama</label>
                                    <input type="text" name="cp_nama" id="cp_nama" placeholder="Masukkan Nama" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_telp">Telpon</label>
                                    <input type="number" name="cp_telp" placeholder="Masukkan Nomor Telpon" id="cp_telp" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_alamat">Alamat</label>
                                    <textarea class="materialize-textarea" id="cp_alamat" name="cp_alamat" data-error=".errorTxt3" placeholder="Masukkan Alamat"></textarea>
                                    <div class="errorTxt3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="rincianmasalah">Rincian Masalah</label>
                                    <textarea class="materialize-textarea" id="rincianmasalah" rows="4" name="rincianmasalah" data-error=".errorTxt4" placeholder="Masukkan Rincian Masalah"></textarea>
                                    <div class="errorTxt4"></div>
                                </div>
                            </div>

                        </div> 
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h5><strong>Usulan Kegiatan</strong></h5>
                            <div class="row">
                                <div class="col s12">
                                    <label for="bidang">Bidang</label>
                                    <select class="error browser-default" name="bidang" id="bidang" data-error=".errorTxt5">
                                        <option value="" disabled selected>Pilih Bidang</option>
                                        @foreach($bidang as $bdg)
                                        <option value="{{$bdg->id_bidang}}">{{ucwords($bdg->bidang)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="distrik">Distrik dan Kampung</label>
                                    <select class="error browser-default" name="distrik" id="distrik" data-error=".errorTxt6">
                                        <option value="" disabled selected>Pilih Distrik dan Kampung</option>
                                        @foreach($distrik as $dist)
                                        <optgroup label="{{strtoupper($dist->nm_distrik)}}">
                                            @foreach($dist->desa as $ds)
                                                <option value="{{$ds->id_desa}}">{{strtoupper($ds->nm_desa)}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt6"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="rincianusulan">Rincian Usulan</label>
                                    <textarea class="materialize-textarea" id="rincianusulan" name="rincianusulan" placeholder="Masukkan Rincian Usulan" data-error=".errorTxt9"></textarea>
                                    <div class="errorTxt9"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6>Upload Dokumen</h6>
                            <div class="file-field input-field col m12">
                                <div class="btn">
                                    <span>Dokumen</span>
                                    <input type="file" name="foto" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate valid" type="text" placeholder="Upload Foto">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit">Kirim Usulan
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>
<!--end container-->
@endsection