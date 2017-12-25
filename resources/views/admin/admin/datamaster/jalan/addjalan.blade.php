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
                <h5 class="breadcrumbs-title">Tambah Distrik</h5>
                <ol class="breadcrumbs">
                    <li><a href="index.html">Beranda</a></li>
                    <li><a href="#">Data Master</a></li>
                    <li class="active">Tambah Distrik</li>
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
                        <form class="col s12 formValidate" method="post" id="formjalan" action="{{url('administrator/data-master/jalan/tambah')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col s12">
                                    <label for="kd_desa">Desa</label>
                                    <select class="error browser-default" id="kd_desa" name="kd_desa" data-error=".errorTxt1">
                                        <option value="" disabled selected>Pilih Desa</option>
                                        @foreach($desa as $ds)
                                        <option value="{{$ds->kd_desa}}">{{ucwords($ds->nm_desa)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="nm_jalan">Nama Jalan</label>
                                    <input type="text" id="nm_jalan" name="nm_jalan" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="status">Status Jalan</label>
                                    <select class="error browser-default" id="status" name="status" data-error=".errorTxt3">
                                        <option value="" disabled selected>Pilih Status Jalan</option>
                                        <option value="confirm">Confirm</option>
                                        <option value="unconfirm">Unconfirm</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt3"></div>
                                    </div>
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
<!--end container-->
@endsection