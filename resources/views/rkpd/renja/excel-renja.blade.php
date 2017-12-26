<?php 
    ob_end_clean();
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment; filename=\"export_".date("d-m-Y").".xls\"");
    header("Content-Transfer-Encoding: binary");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    $jumlah_pagu_awal=0;
    $jumlah_pagu_akhir=0;
?>
<style type="text/css">
    td,th{
        vertical-align: top;
    }
</style>

@foreach($data as $skpd)      
<table border="1">
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