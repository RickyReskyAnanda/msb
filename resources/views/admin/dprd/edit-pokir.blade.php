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
                <h5 class="breadcrumbs-title">Edit Pokok Pikiran</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('dprd')}}">Beranda</a></li>
                    <li><a href="{{url('dprd/pokok-pikiran')}}">Pokok Pikiran</a></li>
                    <li class="active">Edit Pokok Pikiran</li>
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
                        <form class="col s12" class="formValidate" id="formpokir" method="post" action="{{url('dprd/pokok-pikiran/edit')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id_pokir" value="{{$pokir->id_pokir}}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="program_kegiatan"> Program / Kegiatan </label>
                                    <textarea class="materialize-textarea" id="program_kegiatan" name="program_kegiatan" data-error=".errorTxt1">{{$pokir->program_kegiatan}}</textarea>
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="indikator_kinerja"> Indikator Kinerja </label>
                                    <textarea class="materialize-textarea" id="indikator_kinerja" name="indikator_kinerja" data-error=".errorTxt2">{{$pokir->indikator_kinerja}}</textarea>
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="volume">Volume</label>
                                    <input type="number" id="volume" name="volume" value="{{$pokir->volume}}" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="lokasi"> Lokasi </label>
                                    <textarea class="materialize-textarea" id="lokasi" name="lokasi" data-error=".errorTxt4">{{$pokir->lokasi}}</textarea>
                                    <div class="errorTxt4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <label for="skpd_terkait">SKPD Terkait</label>
                                    <select class="error browser-default" id="skpd_terkait" name="skpd_terkait" data-error=".errorTxt5">
                                        <option value="" disabled selected>Pilih SKPD Terkait</option>
                                        @foreach($skpd as $skp)
                                        <option value="{{$skp->nm_skpd}}" <?php if($pokir->skpd_pelaksana == $skp->nm_skpd) echo "selected";?>>{{$skp->nm_skpd}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                        <div class="errorTxt5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="keterangan">Keterangan </label>
                                    <textarea class="materialize-textarea" id="keterangan" name="keterangan" data-error=".errorTxt6">{{$pokir->ket}}</textarea>
                                    <div class="errorTxt6"></div>
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