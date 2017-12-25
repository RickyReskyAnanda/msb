@extends('admin.index')

@section('content')
<style type="text/css">
    th,td{
        border-radius: 0px;
        border: 2px solid #fff;
    }
</style>
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
                <h5 class="breadcrumbs-title">Pantau Usulan</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('/desa')}}">Beranda</a></li>
                    <li class="active">Pantau Usulan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                @if (session('pesan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-navigation-check"></i> SUCCESS : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th>Tingkat Desa</th>
                                            <th>Tingkat Distrik</th>
                                            <th>Tingkat SKPD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        @foreach($usulan as $usul)
                                        <tr>
                                            <td class="green lighten-3" rowspan="4">{{$i++}}</td>
                                            <th class="teal lighten-3">Nama Pekerjaan</th>
                                            <td class="teal lighten-4 center" colspan="3">{{$usul->nm_pekerjaan}}</td>
                                        </tr>
                                        <tr>
                                            <th class="blue lighten-3">Keterangan</th>
                                            <td class="blue lighten-4">{{$usul->keterangan}}</td>
                                            @if(isset($usul->usulanDistrik))
                                            <td class="blue lighten-4">{{$usul->usulanDistrik->keterangan}}</td>
                                            @endif
                                            @if(isset($usul->usulanSKPD))
                                            <td class="blue lighten-4">{{$usul->usulanSKPD->keterangan}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th class="yellow lighten-3">Dana</th>
                                            <td class="yellow lighten-4">
                                                {{$usul->volume.' X '.number_format($usul->harga).' /'.$usul->satuan}}<br>
                                                <b>Hasil : </b> Rp.<?=number_format($usul->volume*$usul->harga)?>
                                            </td>
                                            @if(isset($usul->usulanDistrik))
                                            <td class="yellow lighten-4">
                                                {{$usul->usulanDistrik->volume.' X '.number_format($usul->usulanDistrik->harga).' /'.$usul->usulanDistrik->satuan}}<br>
                                                <b>Hasil : </b> Rp.<?=number_format($usul->usulanDistrik->volume*$usul->usulanDistrik->harga)?>
                                            </td>
                                            @endif
                                            @if(isset($usul->usulanSKPD))
                                            <td class="yellow lighten-4">
                                                {{$usul->usulanSKPD->volume.' X '.number_format($usul->usulanSKPD->harga).' /'.$usul->usulanSKPD->satuan}}<br>
                                                <b>Hasil : </b> Rp.<?=number_format($usul->usulanSKPD->volume*$usul->usulanSKPD->harga)?>
                                            </td>
                                            @endif
                                            
                                        </tr>
                                        <tr>
                                            <th class="deep-orange lighten-3">Status</th>
                                            <td class="deep-orange lighten-4">{{$usul->sts_usulan}}</td>
                                            @if(isset($usul->usulanDistrik))
                                            <td class="deep-orange lighten-4">{{$usul->usulanDistrik->sts_usulan}}</td>
                                            @endif
                                            @if(isset($usul->usulanSKPD))
                                            <td class="deep-orange lighten-4">{{$usul->usulanSKPD->sts_usulan}}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end container-->
@endsection