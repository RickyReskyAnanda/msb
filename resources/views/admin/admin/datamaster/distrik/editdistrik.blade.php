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
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Data Master</li>
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
                        <form class="col s12 formValidate" id="formdistrik" method="post" action="{{url('administrator/data-master/distrik/edit')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id_distrik" value="{{$detail->id_distrik}}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="nm_distrik">Nama Distrik</label>
                                    <input type="text" name="nm_distrik" id="nm_distrik" value="{{$detail->nm_distrik}}" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="sts">Status</label>
                                    <select name="sts" class="error browser-default" id="sts" data-error=".errorTxt2">
                                        <option value="" disabled selected>Pilih Status Distrik</option>
                                        <option value="Y" <?php if($detail->sts == 'Y')echo 'selected'; ?>>Ya</option>
                                        <option value="T" <?php if($detail->sts == 'L')echo 'selected'; ?>>Tidak</option>
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt2"></div>
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