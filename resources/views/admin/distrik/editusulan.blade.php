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
                <h5 class="breadcrumbs-title">Edit Usulan Masuk</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('distrik')}}">Beranda</a></li>
                    <li><a href="{{url('distrik/usulan/masuk')}}">Usulan</a></li>
                    <li class="active">Input Usulan Desa</li>
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
                <div id="card-alert" class="card orange">
                    <div class="card-content white-text">
                        <p><i class="mdi-alert-warning"></i> WARNING : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <style type="text/css">
                </style>
                <form class="col s12 formValidate" id="editusulan" method="post" action="{{url('distrik/usulan/edit')}}" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-content">
                                <span class="card-title">Desa {{ucwords($detail->usulanDesa->desa->nm_desa)}}</span><br>
                                <h5>{{ucwords($detail->nama_pekerjaan)}}</h5>
                                <h5>Biaya Rp.{{number_format($detail->harga).'/'.$detail->satuan}}</h5>
                            </div>
                        </div>
                    </div>
                    {{csrf_field()}}
                    <input type="hidden" name="id_usul_distrik" value="{{$detail->id_usul_distrik}}">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="volume">Jumlah atau Volume</label>
                                    <input type="number" name="volume" value="{{$detail->volume}}" id="volume" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="jalan">Nama Jalan</label>
                                    <select class="browser-default" id="jalan" name="jalan">
                                        <option value="" selected>Nama Jalan</option>
                                        @foreach($detail->usulanDesa->desa->jalan as $jln)
                                        <option value="{{$jln->nm_jalan}}" <?php if($jln->nm_jalan == $detail->jalan)echo "selected";?> >{{$jln->nm_jalan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="ket_nomor">Nomor</label>
                                    <input type="number" name="ket_nomor" value="{{$detail->ket_nomor}}" id="ket_nomor" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="ket_lokasi">Keterangan Lokasi</label>
                                    <textarea class="materialize-textarea" id="ket_lokasi" name="ket_lokasi" data-error=".errorTxt4">{{$detail->ket_lokasi}}</textarea>
                                    <div class="errorTxt4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="link_maps">Link Maps</label>
                                    <textarea class="materialize-textarea" id="link_maps" name="link_maps" data-error=".errorTxt43">{{$detail->link_maps}}</textarea>
                                    <div class="errorTxt43"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="status_lahan">Status Lahan</label>
                                    <select class="error browser-default" id="status_lahan" name="status_lahan" data-error=".errorTxt5">
                                        <option value="" disabled selected>Status Lahan</option>
                                        <option <?php if($detail->status_lahan == "Milik Pemerintah Kota")echo"selected";?>>Milik Pemerintah Kota</option>
                                        <option <?php if($detail->status_lahan == "Milik Instansi Lain")echo"selected";?>>Milik Instansi Lain</option>
                                        <option <?php if($detail->status_lahan == "Milik Warga")echo"selected";?>>Milik Warga</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="keterangan">Keterangan Kebutuhan</label>
                                    <textarea class="materialize-textarea" id="keterangan" name="keterangan" data-error=".errorTxt6">{{$detail->keterangan}}</textarea>
                                    <div class="input-field">
                                        <div class="errorTxt6"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Foto Usulan Desa</span>
                            <div class="row">
                                @foreach($detail->fotodesa as $ft)
                                <div class="col s3">
                                    <div class="card">
                                        <div class="card-image">
                                           <img class="materialboxed responsive-img" src="{{asset('images/usulan/'.$ft->file_foto)}}" alt="sample">
                                        </div>
                                        <div class="card-action">
                                            <a href="{{url('distrik/usulan/edit/hapus-gambar/'.$ft->id_foto)}}" class="red-text"><i class="mdi-navigation-close small"></i>Hapus</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Tambahkan Foto</span>
                            <div class="row">
                                <div class="file-field input-field col m12">
                                    <div class="btn">
                                      <span>Foto</span>
                                      <input type="file" multiple name="foto[]">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input class="file-path validate valid" type="text" placeholder="Upload 1 atau lebih foto">
                                    </div>
                                    * input untuk menambahkan foto foto
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit">Perbaharui Usulan
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