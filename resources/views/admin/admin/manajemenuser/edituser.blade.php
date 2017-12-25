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
                <h5 class="breadcrumbs-title">Edit User <?php if($level == 'desa')echo "Kampung";else echo ucfirst($level);?></h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Manajemen User</li>
                    <li class="active">Edit User <?php if($level == 'desa')echo "Kampung";else echo ucfirst($level);?></li>
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
                <div class="card-panel">
                    <div class="row">
                        <form class="col s12" method="post" class="formValidate" id="manajemenuser" action="{{url('administrator/manajemen-user/'.$level.'/edit')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id_user" value="{{$detail->id}}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="name"> Nama</label>
                                    <input type="text" name="name" id="name" value="{{$detail->name}}" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            @if($level=='administrator')
                            <div class="row">
                                <div class=" col s12">
                                    <label for="level">Level</label>
                                    <select class="error browser-default" id="level" name="level" data-error=".errorTxt2">
                                        <option value="" disabled selected>Level</option>
                                        <option value="administrator" <?php if($detail->level == 'administrator')echo "selected";?>>Administrator</option>
                                        <option value="bappeda" <?php if($detail->level == 'bappeda')echo "selected";?>>Bappeda</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt2"></div>
                                    </div>
                                </div>
                            </div>
                            @elseif($level=='skpd')
                            <div class="row">
                                <div class="col s12">
                                    <label for="skpd">SKPD</label>
                                    <select class="error browser-default" id="skpd" name="skpd" data-error=".errorTxt3">
                                        <option value="" disabled selected>Pilih SKPD</option>
                                        @foreach($skpd as $skp)
                                        <option value="{{$skp->id_skpd}}" <?php if($detail->kode_wilayah == $skp->id_skpd)echo "selected";?>>{{$skp->nm_skpd}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @elseif($level=='distrik')
                            <div class="row">
                                <div class="col s12">
                                    <label for="distrik">Distrik</label>
                                    <select class="error browser-default" id="distrik" name="distrik" data-error=".errorTxt4">
                                        <option value="" disabled selected>Pilih Distrik</option>
                                        @foreach($distrik as $dist)
                                        <option value="{{$dist->kd_distrik}}" <?php if($detail->kode_wilayah == $dist->kd_distrik)echo "selected";?>>{{$dist->nm_distrik}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt4"></div>
                                    </div>
                                </div>
                            </div>
                            @elseif($level=='desa')
                            <div class="row">
                                <div class="col s12">
                                    <label for="desa">Kampung</label>
                                    <select class="error browser-default" id="desa" name="desa" data-error=".errorTxt5">
                                        <option value="" disabled selected>Pilih Kampung</option>
                                        @foreach($distrik as $dist)
                                        <optgroup label="{{$dist->nm_distrik}}">
                                            @foreach($dist->desa as $ds)
                                                <option value="{{$ds->kd_desa}}" <?php if($detail->kode_wilayah == $ds->kd_desa)echo "selected";?>>{{$ds->nm_desa}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt5"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class=" col s12">
                                    <label for="status">Status</label>
                                    <select class="error browser-default" id="status" name="status" data-error=".errorTxt10">
                                        <option value="" disabled selected>Status</option>
                                        <option value="terbuka" <?php if($detail->status == 'terbuka')echo "selected";?>>Terbuka</option>
                                        <option value="terkunci" <?php if($detail->status == 'terkunci')echo "selected";?>>Terkunci</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt10"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" value="{{$detail->username}}" data-error=".errorTxt6">
                                    <div class="errorTxt6"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="pass">Password</label>
                                    <input type="password" id="pass" name="pass" data-error=".errorTxt7">
                                    <div class="errorTxt7"></div>
                                    *input untuk mengganti password
                                </div>
                                <div class="input-field col s6">
                                    <label for="confirm">Konfirmasi Password</label>
                                    <input type="password" name="confirm" id="confirm" data-error=".errorTxt8">
                                    <div class="errorTxt8"></div>
                                    *input konfirmasi password untuk mengganti
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit">Simpan
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection