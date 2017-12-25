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
                <h5 class="breadcrumbs-title">Tambah User <?php if($level == 'desa')echo "Kampung";else echo ucfirst($level);?></h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Manajemen User</li>
                    <li class="active">Tambah User <?php if($level == 'desa')echo "Kampung";else echo ucfirst($level);?></li>
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
                        <form class="formValidate col s12" method="post"  id="manajemenuser" action="{{url('administrator/manajemen-user/'.$level.'/tambah')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="name"> Nama</label>
                                    <input type="text" name="name" id="name" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            @if($level=='administrator')
                            <div class="row">
                                <div class=" col s12">
                                    <label for="level">Level</label>
                                    <select class="error browser-default" id="level" name="level" data-error=".errorTxt2">
                                        <option value="" disabled selected>Level</option>
                                        <option value="administrator">Administrator</option>
                                        <option value="bappeda">Bappeda</option>
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
                                        <option value="{{$skp->id_skpd}}">{{$skp->nm_skpd}}</option>
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
                                        <option value="{{$dist->kd_distrik}}">{{$dist->nm_distrik}}</option>
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
                                                <option value="{{$ds->kd_desa}}">{{$ds->nm_desa}}</option>
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
                                <div class="input-field col s12">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" data-error=".errorTxt6">
                                    <div class="errorTxt6"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" data-error=".errorTxt7">
                                    <div class="errorTxt7"></div>
                                    
                                </div>
                                <div class="input-field col s6">
                                    <label for="confirmation">Konfirmasi Password</label>
                                    <input type="password" name="confirmation" id="confirmation" data-error=".errorTxt8">
                                    <div class="errorTxt8"></div>
                                   
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