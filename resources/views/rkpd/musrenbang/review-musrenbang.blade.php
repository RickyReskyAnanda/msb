@extends('rkpd.index')

@section('content')
<style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 4px;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Review Musrenbang</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li class="active">
                <strong>Review Musrenbang</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Filter SKPD</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form method="get" action="{{url('administrator/review-musrenbang')}}">
                            <div class="col-md-9">
                                <select name="skpd" class="form-control">
                                    <option value="semua" selected="">Semua SKPD</option>
                                    <?php $i=0;
                                    foreach($skpd as $skpd1){
                                    ?>
                                    <option value="{{$skpd1->id_skpd}}" <?php if(isset($request->skpd) && $skpd1->id_skpd == $request->skpd)echo "selected"; ?>>{{$skpd1->nm_skpd}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Cari Hasil Musrenbang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Review Musrenbang</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Usulan</th>
                                    <th>Biaya</th>
                                    <th>Kondisi</th>
                                    <th>Foto-Foto Kondisi</th>
                                    <th>Status dan Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($usulan as $usul)
                                <tr>
                                    <td>
                                        <div class="widget p-xs text-center">
                                            <b>{{$i++}}</b>
                                        </div>
                                        <div class="widget p-xs text-center">
                                            <b>Kampung: </b><br>
                                            {{ucwords($usul->desa->nm_desa)}}
                                        </div>
                                        <div class="widget p-xs text-center">
                                            <b>Distrik: </b><br>
                                            {{ucwords($usul->distrik->nm_distrik)}}
                                        </div>
                                        <div class="widget p-xs text-center">
                                            <b>SKPD Pelaksana: </b><br>
                                            {{$usul->skpd->nm_skpd}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget p-xs">
                                            <h5>{{$usul->nama_pekerjaan}}</h5>
                                        </div>
                                        <div class="widget p-xs">
                                                <b>Jalan : </b><br>
                                                {{$usul->jalan}}
                                        </div>
                                        <div class="widget p-xs">
                                                <b>Ket : </b><br>
                                                {{$usul->keterangan}}
                                        </div>
                                        <div class="widget p-xs">
                                                <b>Contact Person :</b><br>
                                                {{ucwords($usul->cp_nama)}}<br>
                                                {{$usul->cp_alamat}}<br>
                                                <b>Telp : </b>{{$usul->cp_telp}}<br>
                                                <b>HP : </b>{{$usul->cp_hp}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget p-xs">
                                                {{$usul->volume}}X{{number_format($usul->harga)}}/{{$usul->satuan}}<br>
                                                <b>Hasil : </b> Rp.{{number_format($usul->volume*$usul->harga)}}                                                  </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget p-xs">
                                                <b>Kondisi saat ini : </b><br>{{$usul->faktor1}}
                                        </div>
                                        <div class="widget p-xs">
                                                <b>Tingkat Kebutuhan atau Pemakaian: </b><br>{{$usul->faktor2}}
                                        </div>
                                        <div class="widget p-xs">
                                                <b>Dampak Kegiatan: </b><br>{{$usul->faktor3}}
                                        </div>
                                        <div class="widget p-xs">
                                                <b>SKOR : {{$usul->skor}}</b>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($usul->fotodesa as $foto)
                                            <img src="{{asset('images/usulan/thumb/'.$foto->file_foto)}}" class="img-responsive">
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="widget p-xs">
                                            <b>Status:</b><br>
                                            <p>{{$usul->sts_usulan}}</p>
                                        </div>
                                        <div class="widget p-xs">
                                            <?php if(!isset($usul->rkpd->id_rkpd)) {?>
                                            <b>TIndakan:</b><br>
                                            <a href="{{url('rkpd/administrator/input-rkpd/manual_msb/'.$usul->id_usul_bappeda)}}" class="btn btn-primary">Input RKPD</a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(!isset($request->skpd) || $request->skpd=='semua')
                    <div class="row">
                        @if($usulan->total() > 0)
                        <div class="col-md-12">
                            <span>Record <?=$usulan->firstItem().'-'.$usulan->lastItem().' from '.$usulan->lastPage()?> page</span>
                        </div>
                        @endif
                        @if($usulan->total() > 10)
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{$usulan->previousPageUrl()}}" class="btn btn-primary">Sebelumnya</a>
                            <a href="{{$usulan->nextPageUrl()}}" class="btn btn-primary">Selanjutnya</a>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div>
            <strong>Copyright</strong> BAPPEDA KABUPATEN YALIMO
        </div>
    </div>

</div>

@endsection