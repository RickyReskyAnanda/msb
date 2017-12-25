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
                <h5 class="breadcrumbs-title">Berita Acara Distrik</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('distrik')}}">Beranda</a></li>
                    <li class="active">Berita Acara Distrik</li>
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
                        <form class="col s12 formValidate" id="inputba" name="formdata" method="post" action="{{url('distrik/berita-acara')}}">
                            {{csrf_field()}}
                            @if(isset($ba->id_ba))
                            <input type="hidden" name="id_ba" value="{{$ba->id_ba}}">
                            @endif
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="no_ba">Nomor</label>
                                    <input type="text" name="no_ba" id="no_ba" value="<?php if(isset($ba->no_ba)) echo $ba->no_ba;?>" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="tgl_ba">Tanggal Berita Acara</label>
                                    <input type="text" name="tgl_ba" id="tgl_ba" value="<?php if(isset($ba->tgl_ba)) echo $ba->tgl_ba;?>" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="pemateri_lain">Pemateri Lain</label>
                                    <input type="text" name="pemateri_lain" id="pemateri_lain" value="<?php if(isset($ba->pemateri_lain)) echo $ba->pemateri_lain;?>" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="pemateri_lain">Pimpinan Sidang</label>
                                    <input type="text" name="pimpinan_sidang" id="pimpinan_sidang" value="<?php if(isset($ba->pimpinan_sidang)) echo $ba->pimpinan_sidang;?>" data-error=".errorTxt4">
                                    <div class="errorTxt4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m4">
                                    <label for="hari">Hari</label>
                                    <select class="error browser-default" name="hari" id="hari" data-error=".errorTxt5">
                                        <option value="" disabled selected>Pilih Hari</option>
                                        <option value="Senin" <?php if(isset($ba->hari) && $ba->hari=='Senin')echo "selected";?>>Senin</option>
                                        <option value="Selasa" <?php if(isset($ba->hari) && $ba->hari=='Selasa')echo "selected";?>>Selasa</option>
                                        <option value="Rabu" <?php if(isset($ba->hari) && $ba->hari=='Rabu')echo "selected";?>>Rabu</option>
                                        <option value="Kamis" <?php if(isset($ba->hari) && $ba->hari=='Kamis')echo "selected";?>>Kamis</option>
                                        <option value="Jumat" <?php if(isset($ba->hari) && $ba->hari=='Jumat')echo "selected";?>>Jumat</option>
                                        <option value="Sabtu" <?php if(isset($ba->hari) && $ba->hari=='Sabtu')echo "selected";?>>Sabtu</option>
                                        <option value="Minggu" <?php if(isset($ba->hari) && $ba->hari=='Minggu')echo "selected";?>>Minggu</option>
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
                                    <input type="text" name="tempat" id="tempat" value="<?php if(isset($ba->tempat)) echo $ba->tempat;?>" data-error=".errorTxt8">
                                    <div class="errorTxt8"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn green right"  style="margin: 10px 10px 0 10px">Simpan</button>
                                    <a href="{{url('distrik/berita-acara/cetak')}}" class="btn orange right"  style="margin: 10px 0">cetak</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                @if(isset($ba->hari))
                <div class="card">
                    <div class="card-content">
                        <h6><strong>Sambutan - Sambutan</strong></h6>
                        <div class="row">
                            <div class="col s12">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                            
                                        <tr>
                                            <form class="col s12 formValidate" name="formsambutan" id="formsambutan" method="post" action="{{url('distrik/berita-acara/sambutan')}}">
                                                

                                                {{csrf_field()}}
                                                <input type="hidden" name="id_ba" value="{{$ba->id_ba}}">
                                                <th colspan="2">
                                                    <div class="input-field">
                                                        <input type="text" name="sambutan" id="sambutan"  data-error=".errorTxt9" required placeholder="Masukkan Nama Pemberi Sambutan">
                                                        <div class="errorTxt9"></div>
                                                    </div>
                                                </th>
                                                <th><button class="btn" type="submit">Simpan</button></th>
                                            </form>
                                        </tr>
                                    </thead>
                                    <tbody id="datasambutan">
                                        <?php 
                                        $i=1;
                                        if(isset($ba->sambutan))
                                        foreach($ba->sambutan as $sambutan){?>
                                        <tr>
                                            <td>{{$i++}}</td>  
                                            <td>{{$sambutan->sambutan_oleh}}</td>
                                            <td>
                                                <a href="{{url('distrik/berita-acara/hapus/sambutan/'.$sambutan->id)}}" class="btn red">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h6><strong>Peserta</strong></h6>
                        <div class="row">
                            <div class="col s12">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Asal</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tr>
                                            <form class="col s12 " name="formpeserta" id="formpeserta" method="post" action="{{url('distrik/berita-acara/peserta')}}">
                                                <input type="hidden" name="id_ba" value="{{$ba->id_ba}}">
                                                {{csrf_field()}}
                                                <th colspan="2"><input name="nama_p" id="nama_p" required type="text" placeholder="Masukkan Nama Peserta"></th>
                                        
                                                <th><input name="asal_p" id="asal_p" required type="text" placeholder="Masukkan Asal Daerah Peserta"></th>
                                                <th><input name="alamat_p" id="alamat_p" type="text" required placeholder="Masukkan Alamat Peserta"></th>
                                                <th><button class="btn" type="submit">Simpan</button></th>
                                            </form>
                                        </tr>
                                    </thead>
                                    <tbody id="datapeserta">
                                        <?php 
                                        $i=1;
                                        if(isset($ba->peserta))
                                        foreach($ba->peserta as $peserta){ ?>
                                        <tr>
                                            <td>{{$i++}}</td>  
                                            <td>{{$peserta->anggota}}</td>
                                            <td>{{$peserta->asal}}</td>
                                            <td>{{$peserta->alamat}}</td>
                                            <td>
                                                <a href="{{url('distrik/berita-acara/hapus/peserta/'.$peserta->id)}}" class="btn red">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h6><strong>Delegasi</strong></h6>
                        <div class="row">
                            <div class="col s12">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Asal</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>

                                        <tr>
                                        <form class="col s12" name="formdelegasi" id="formdelegasi" method="post" action="{{url('distrik/berita-acara/delegasi')}}">
                                            <input type="hidden" name="id_ba" value="{{$ba->id_ba}}">
                                            {{csrf_field()}}
                                            <th colspan="2"><input name="nama_d" id="nama_d" required type="text" placeholder="Masukkan Nama Delegasi"></th>
                                            <th><input name="asal_d" id="asal_d" type="text" required placeholder="Masukkan Asal Daerah Delegasi"></th>
                                            <th><input name="alamat_d" id="alamat_d" type="text" required placeholder="Masukkan Alamat Delegasi"></th>
                                            <th><button class="btn" type="submit">Simpan</button></th>
                                        </form>
                                        </tr>
                       
                                    </thead>
                                    <tbody>
                                        <?php $i=1;
                                        if(isset($ba->delegasi))
                                        foreach($ba->delegasi as $delegasi){ ?>
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$delegasi->delegasi_nama}}</td>
                                            <td>{{$delegasi->asal}}</td>
                                            <td>{{$delegasi->alamat}}</td>
                                            <td>
                                                <a href="{{url('distrik/berita-acara/hapus/delegasi/'.$delegasi->id)}}" class="btn red">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end container-->
@endsection