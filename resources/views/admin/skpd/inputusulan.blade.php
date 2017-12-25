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
                <h5 class="breadcrumbs-title">Input Usulan</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('skpd')}}">Beranda</a></li>
                    <li class="active">Input Usulan</li>
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


                <form class="col s12 formValidate" id="inputusulan" method="post" action="{{url('skpd/usulan/input')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id_pekerjaan" value="{{$usulan->id_pekerjaan}}">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-content">
                                <h5>{{$usulan->nama_pekerjaan}}</h5>
                                <h5>Biaya Rp.{{number_format($usulan->harga_satuan).'/'.$usulan->satuan}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6><strong>Pilih Daerah</strong></h6>
                            <div class="row">
                                <div class="col s12">
                                    <label for="distrik">Pilih Distrik</label>
                                    <select class="error browser-default" name="distrik" id="distrik" data-error=".errorTxt18">
                                        <option value="" disabled selected>Pilih Distrik</option>
                                        @foreach($distrik as $dist)
                                        <option value="{{$dist->kd_distrik}}">{{strtoupper($dist->nm_distrik)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt18"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="desa">Pilih Kampung</label>
                                    <select class="error browser-default" name="desa" id="desa" data-error=".errorTxt19">
                                        <option value="" disabled selected>Pilih Kampung</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt19"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6><strong>Pilih Tingkat Usulan</strong></h6>
                            <div class="row">
                                <div class="col s12">
                                    <label for="level_usulan">Tingkat Usulan*</label>
                                    <select class="error browser-default" name="level_usulan" id="level_usulan" data-error=".errorTxt1">
                                        <option value="" disabled selected>Pilih Tingkat Usulan</option>
                                        <option value="UTAMA">UTAMA</option>
                                        <option value="CADANGAN">CADANGAN</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt1"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="volume">Jumlah atau Volume</label>
                                    <input type="number" name="volume" id="volume" data-error=".errorTxt12">
                                    <div class="errorTxt12"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="jalan">Nama Jalan</label>
                                    <select class="browser-default"  name="jalan" id="jalan">
                                        <option value="" selected>Pilih Jalan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="ket_nomor">Nomor</label>
                                    <input type="number" id="ket_nomor" name="ket_nomor" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="ket_lokasi">Keterangan Lokasi</label>
                                    <textarea class="materialize-textarea" id="ket_lokasi" name="ket_lokasi" data-error=".errorTxt4"></textarea>
                                    <div class="errorTxt4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="link_maps">Link Maps</label>
                                    <textarea class="materialize-textarea" id="link_maps" name="link_maps" data-error=".errorTxt43"></textarea>
                                    <div class="errorTxt43"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="status_lahan">Status Lahan</label>
                                    <select class="error browser-default" name="status_lahan" id="status_lahan" data-error=".errorTxt41">
                                        <option value="" disabled selected>Status Lahan</option>
                                        <option>Milik Pemerintah Kota</option>
                                        <option>Milik Instansi Lain</option>
                                        <option>Milik Warga</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt41"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="keterangan">Keterangan Kebutuhan</label>
                                    <textarea class="materialize-textarea" id="keterangan" name="keterangan" data-error=".errorTxt5"></textarea>
                                    <div class="errorTxt5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6><strong>Kondisi Saat Ini</strong></h6>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p>
                                        <input class="with-gap" name="faktor1" type="radio" id="f11" value="1" checked>
                                        <label for="f11">{{$usulan->skoring->faktor1_nilai1}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor1" type="radio" id="f12" value="2">
                                        <label for="f12">{{$usulan->skoring->faktor1_nilai2}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor1" type="radio" id="f13" value="3">
                                        <label for="f13">{{$usulan->skoring->faktor1_nilai3}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor1" type="radio" id="f14" value="4">
                                        <label for="f14">{{$usulan->skoring->faktor1_nilai4}}</label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6><strong>Tingkat Kebutuhan/Pemakaian</strong></h6>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p>
                                        <input class="with-gap" name="faktor2" type="radio" id="f21" value="1" checked>
                                        <label for="f21">{{$usulan->skoring->faktor2_nilai1}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor2" type="radio" id="f22" value="2">
                                        <label for="f22">{{$usulan->skoring->faktor2_nilai2}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor2" type="radio" id="f23" value="3">
                                        <label for="f23">{{$usulan->skoring->faktor2_nilai3}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor2" type="radio" id="f24" value="4">
                                        <label for="f24">{{$usulan->skoring->faktor2_nilai4}}</label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6><strong>Dampak Kegiatan</strong></h6>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p>
                                        <input class="with-gap" name="faktor3" type="radio" id="f31" value="1" checked>
                                        <label for="f31">{{$usulan->skoring->faktor3_nilai1}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor3" type="radio" id="f32" value="2">
                                        <label for="f32">{{$usulan->skoring->faktor3_nilai2}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor3" type="radio" id="f33" value="3">
                                        <label for="f33">{{$usulan->skoring->faktor3_nilai3}}</label>
                                    </p>
                                    <p>
                                        <input class="with-gap" name="faktor3" type="radio" id="f34" value="4">
                                        <label for="f34">{{$usulan->skoring->faktor3_nilai4}}</label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="file-field input-field col m12">
                                    <div class="btn">
                                      <span>Foto</span>
                                      <input type="file" multiple name="foto[]" >
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input class="file-path validate valid" type="text" placeholder="Upload one or more files">
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <h6><strong>Kontak</strong></h6>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_nama">Nama</label>
                                    <input type="text" name="cp_nama" id="cp_nama" data-error=".errorTxt6">
                                    <div class="errorTxt6"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_alamat" >Alamat</label>
                                    <input type="text" name="cp_alamat" id="cp_alamat"  data-error=".errorTxt7">
                                    <div class="errorTxt7"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="cp_telp">Telpon</label>
                                    <input type="number" name="cp_telp" id="cp_telp" data-error=".errorTxt8">
                                    <div class="errorTxt8"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="number" name="cp_hp">
                                    <label>HP (optional)</label>
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
<script type="text/javascript">
    $('select[name=distrik]').change(function(){
        $.get("{{url('api/wilayah/desabydistrik')}}/"+$(this).val(),function(data, status){
            $('select[name=desa]').html('<option value="" disabled selected>Pilih Kampung</optional>');

            if(data.length > 0){
                data.forEach(function(value,index){
                    $('select[name=desa]').append('<option value="'+value.kd_desa+'">'+value.nm_desa.toUpperCase()+'</option>');
                });
            }
        });
    });

    $('select[name=desa]').change(function(){
        $.get("{{url('api/wilayah/jalanbydesa')}}/"+$(this).val(),function(data, status){
            $('select[name=jalan]').html('<option value="" selected>Pilih Jalan</optional>');

            if(data.length > 0){
                data.forEach(function(value,index){
                    $('select[name=jalan]').append('<option value="'+value.nm_jalan+'">'+value.nm_jalan+'</option>');
                });
            }
        });
    });
</script>
<!--end container-->
@endsection