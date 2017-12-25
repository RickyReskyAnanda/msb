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
                <h5 class="breadcrumbs-title">Tambah Skoring</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Data Master</li>
                    <li class="active">Tambah Skoring</li>
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
                        <form class="col s12 formValidate" method="post" id="skoring" action="{{url('administrator/skoring/tambah')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="nama_kelompok">Nama Kelompok</label>
                                    <input type="text" name="nama_kelompok" id="nama_kelompok" data-error=".errorTxt1" placeholder="*pisah dengan koma (,)">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            <h4 class="header2">Faktor 1</h4>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="faktor1_nilai1">Nilai 1</label>
                                    <input type="text" name="faktor1_nilai1" id="faktor1_nilai1" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor1_nilai2">Nilai 2</label>
                                    <input type="text" name="faktor1_nilai2" id="faktor1_nilai2" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor1_nilai3">Nilai 3</label>
                                    <input type="text" name="faktor1_nilai3" id="faktor1_nilai3" data-error=".errorTxt4">
                                    <div class="errorTxt4"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor1_nilai4">Nilai 4</label>
                                    <input type="text" name="faktor1_nilai4" id="faktor1_nilai4" data-error=".errorTxt5">
                                    <div class="errorTxt5"></div>
                                </div>
                            </div>

                            <h4 class="header2">Faktor 2</h4>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="faktor2_nilai1">Nilai 1</label>
                                    <input type="text" name="faktor2_nilai1" id="faktor2_nilai1" data-error=".errorTxt6">
                                    <div class="errorTxt6"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor2_nilai2">Nilai 2</label>
                                    <input type="text" name="faktor2_nilai2" id="faktor2_nilai2" data-error=".errorTxt7">
                                    <div class="errorTxt7"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor2_nilai3">Nilai 3</label>
                                    <input type="text" name="faktor2_nilai3" id="faktor2_nilai3" data-error=".errorTxt8">
                                    <div class="errorTxt8"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor2_nilai4">Nilai 4</label>
                                    <input type="text" name="faktor2_nilai4" id="faktor2_nilai4" data-error=".errorTxt9">
                                    <div class="errorTxt9"></div>
                                </div>
                            </div>

                            <h4 class="header2">Faktor 3</h4>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="faktor3_nilai1">Nilai 1</label>
                                    <input type="text" name="faktor3_nilai1" id="faktor3_nilai1" data-error=".errorTxt10">
                                    <div class="errorTxt10"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor3_nilai2">Nilai 2</label>
                                    <input type="text" name="faktor3_nilai2" id="faktor3_nilai2" data-error=".errorTxt11">
                                    <div class="errorTxt11"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor3_nilai3">Nilai 3</label>
                                    <input type="text" name="faktor3_nilai3" id="faktor3_nilai3" data-error=".errorTxt12">
                                    <div class="errorTxt12"></div>
                                </div>
                                <div class="input-field col s6">
                                    <label for="faktor3_nilai4">Nilai 4</label>
                                    <input type="text" name="faktor3_nilai4" id="faktor3_nilai4" data-error=".errorTxt13">
                                    <div class="errorTxt13"></div>
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