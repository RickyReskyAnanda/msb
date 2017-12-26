@extends('rkpd.index')

@section('content')
<style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 4px;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Laporan Renja</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li class="active">
                <strong>Laporan Renja</strong>
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
                        <form method="get" action="{{url('rkpd/administrator/laporan-renja')}}">
                            <div class="col-md-6">
                                <select name="skpd" class="form-control" required>
                                    <option value="semua" selected>Pilih Semua SKPD</option>
                                    <?php $i=0;
                                    foreach($skpd as $skpd1){
                                    ?>
                                    <option value="{{$skpd1->id_skpd}}" <?php if(isset($request->skpd) && $skpd1->id_skpd == $request->skpd)echo "selected"; ?>>{{$skpd1->nm_skpd}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="tahun" class="form-control" required>
                                    <?php for($i=0;$i<5;$i++){?>
                                    <option value="<?= $tahun_ap+$i ?>" <?php if(($tahun_ap+$i) == $tahun)echo "selected";?>>{{$tahun_ap+$i}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" name="cari" value="cari"><i class="fa fa-plus"></i> Cari</button>
                                <button type="submit" class="btn btn-primary" name="cari" value="cetak"><i class="fa fa-plus"></i> Cetak Laporan </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Laporan Renja</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive" style="margin-top: 15px;">
                    @foreach($data as $skpd)      
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="10"><h3 align="center">Rumusan Rencana Program dan Kegiatan SKPD Tahun {{$tahun}}</h3></th>
                            </tr>
                            <tr>
                                <th colspan="10"><h3 align="center">dan Prakiraan Maju Tahun {{$tahun+1}}</h3></th>
                            </tr>
                            <tr>
                                <th colspan="10"><h3 align="center">Kabupaten Yalimo</h3></th>
                            </tr>
                            <tr>
                                <th colspan="10"><h3 align="left">SKPD : {{$skpd->skpd->nm_skpd}}</h3></th>
                            </tr>
                            <tr>
                                <th rowspan="2">Kode</th>
                                <th rowspan="2">Urusan/Bidang Urusan Pemerintah Daerah dan Program/Kegiatan</th>
                                <th rowspan="2">Indikator Kinerja Program/Kegiatan</th>
                                <th colspan="4">Rencana Tahun {{$tahun}} (tahun rencana)</th>
                                <th rowspan="2">Catatan Penting</th>
                                <th colspan="2">Perkiraan Maju Rencana {{$tahun+1}}</th>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <th>Target Capaian Kinerja</th>
                                <th>Kebutuhan Dana/ pagu indikatif</th>
                                <th>Sumber Dana</th>
                                <th>Target Capaian Kinerja</th>
                                <th>Kebutuhan Dana/Pagu Indikatif</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $wajib = 0;?>
                            @foreach($skpd->bidang as $bidang)
                            @if($bidang->bidang->sts == '1')
                            <?php $wajib++;
                            if($wajib == 1){
                            ?>
                            <tr>
                                <td><b>01</b></td>
                                <td><b>Wajib</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <td><b>01.<?php if(isset($bidang->bidang->kode_bidang))echo $bidang->bidang->kode_bidang?></b></td>
                                <td><b><?php if(isset($bidang->bidang->bidang))echo $bidang->bidang->bidang?></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>01.<?php if(isset($bidang->bidang->kode_bidang))echo $bidang->bidang->kode_bidang?>.<?php if(isset($skpd->skpd->kode))echo $skpd->skpd->kode?></b></td>
                                <td><b><?php if(isset($skpd->skpd->nm_skpd))echo $skpd->skpd->nm_skpd?></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($bidang->program as $program)
                            <tr>
                                <td><b>01.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}</b></td>
                                <td><b>{{$program->program->program}}</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $kode=0;?>
                            @foreach($program->kegiatan as $kegiatan)
                            <tr>
                                <td><b>01.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}.{{$kode++}}</b></td>
                                <td>{{$kegiatan->nm_kegiatan}}</td>
                                <td>{{$kegiatan->indikator_kinerja}}</td>
                                <td>{{$kegiatan->lokasi}}</td>
                                <td>{{number_format($kegiatan->target).' '.$kegiatan->satuan}}</td>
                                <td>Rp.{{number_format($kegiatan->pagu_indikatif)}}</td>
                                <td>{{$kegiatan->sumber_dana}}</td>
                                <td>{{$kegiatan->catatan_penting}}</td>
                                <td>{{number_format($kegiatan->prakiraan_target).' '.$kegiatan->satuan}}</td>
                                <td>Rp.{{number_format($kegiatan->prakiraan_pagu)}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                            @endforeach



                            <?php $pilihan = 0;?>
                            @foreach($skpd->bidang as $bidang)
                            @if($bidang->bidang->sts == '2')
                            <?php $pilihan++;
                            if($pilihan == 1){
                            ?>
                            <tr>
                                <td><b>02</b></td>
                                <td><b>Pilihan</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <td><b>02.<?php if(isset($bidang->bidang->kode_bidang))echo $bidang->bidang->kode_bidang?></b></td>
                                <td><b><?php if(isset($bidang->bidang->bidang))echo $bidang->bidang->bidang?></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>02.<?php if(isset($bidang->bidang->kode_bidang))echo $bidang->bidang->kode_bidang?>.<?php if(isset($skpd->skpd->kode))echo $skpd->skpd->kode?></b></td>
                                <td><b><?php if(isset($skpd->skpd->nm_skpd))echo $skpd->skpd->nm_skpd?></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($bidang->program as $program)
                            <tr>
                                <td><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}</b></td>
                                <td><b>{{$program->program->program}}</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $kode=0;?>
                            @foreach($program->kegiatan as $kegiatan)
                            <tr>
                                <td><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}.{{$kode++}}</b></td>
                                <td>{{$kegiatan->nm_kegiatan}}</td>
                                <td>{{$kegiatan->indikator_kinerja}}</td>
                                <td>{{$kegiatan->lokasi}}</td>
                                <td>{{number_format($kegiatan->target).' '.$kegiatan->satuan}}</td>
                                <td>Rp.{{number_format($kegiatan->pagu_indikatif)}}</td>
                                <td>{{$kegiatan->sumber_dana}}</td>
                                <td>{{$kegiatan->catatan_penting}}</td>
                                <td>{{number_format($kegiatan->prakiraan_target).' '.$kegiatan->satuan}}</td>
                                <td>Rp.{{number_format($kegiatan->prakiraan_pagu)}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                            @endforeach

                            <tr>
                                <th colspan='5'>Jumlah</th>
                                <th>Rp.</th>
                                <th colspan="3"></th>
                                <th>Rp.</th>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    </div>
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