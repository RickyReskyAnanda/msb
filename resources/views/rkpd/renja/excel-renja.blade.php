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

<table border='1'>
    <thead>
        <tr>
            <th colspan="12"><h2 align="center">Rumusan Rencana Program dan Kegiatan SKPD Tahun {{$kode}}</h2></th>
        </tr>
        <tr>
            <th colspan="12"><h2 align="center">dan Prakiraan Maju Tahun {{$kode+1}}</h2></th>
        </tr>
        <tr>
            <th colspan="12"><h2 align="center">Kabupaten Yalimo</h2></th>
        </tr>
        <tr>
            <th rowspan="2">Kode</th>
            <th rowspan="2">Urusan/Bidang Urusan Pemerintah Daerah dan Program/Kegiatan</th>
            <th rowspan="2">Indikator Kinerja Program/Kegiatan</th>
            <th colspan="4">Rencana Tahun 2018 (tahun rencana)</th>
            <th rowspan="2">Catatan Penting</th>
            <th colspan="2">Perkiraan Maju Rencana 2019</th>
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
        <?php $i=0; ?>
        @foreach($renja as $waj)
        @if($waj->sts == 1)
        @if($i == 0)
        <?php $i++;?>
        <tr>
            <th>1</th>
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
        @endif

        <tr>
            <td>1.{{$waj->kd_bidang}}</td>
            <td style="padding-left: 10px"><b>{{ucwords($waj->bidang)}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
            @foreach($waj->getprogram as $getprogram)
            <tr>
                <td>1.{{$waj->kd_bidang.'.'.$getprogram->kd_prog}}</td>
                <td style="padding-left: 20px"><b>{{ucwords($getprogram->program)}}</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                @foreach($getprogram->getkegiatan as $getkegiatan)
                <tr>
                    <td>1.{{$waj->kd_bidang.'.'.$getprogram->kd_prog.'.'.$getkegiatan->kd_kegiatan}}</td>
                    <td style="padding-left: 30px">{{ucwords($getkegiatan->nm_kegiatan)}}</td>
                    <td><?php if(isset($getkegiatan->detail->indikator_kinerja))echo $getkegiatan->detail->indikator_kinerja;?></td>
                    <td><?php if(isset($getkegiatan->detail->lokasi))echo $getkegiatan->detail->lokasi;?></td>
                    <td>
                        <?php 

                        if($kode == 0 && isset($getkegiatan->detail->target_capaian_1))echo $getkegiatan->detail->target_capaian_1;
                        elseif($kode == 1 && isset($getkegiatan->detail->target_capaian_2))echo $getkegiatan->detail->target_capaian_2;
                        elseif($kode == 2 && isset($getkegiatan->detail->target_capaian_3))echo $getkegiatan->detail->target_capaian_3;
                        elseif($kode == 3 && isset($getkegiatan->detail->target_capaian_4))echo $getkegiatan->detail->target_capaian_4;
                        elseif($kode == 4 && isset($getkegiatan->detail->target_capaian_5))echo $getkegiatan->detail->target_capaian_5;
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($kode == 0 && isset($getkegiatan->detail->pagu_indikatif_1)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_1);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_1;
                        }
                        elseif($kode == 1 && isset($getkegiatan->detail->pagu_indikatif_2)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_2);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_2;
                        }
                        elseif($kode == 2 && isset($getkegiatan->detail->pagu_indikatif_3)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_3);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_3;
                        }
                        elseif($kode == 3 && isset($getkegiatan->detail->pagu_indikatif_4)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_4);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_4;
                        }
                        elseif($kode == 4 && isset($getkegiatan->detail->pagu_indikatif_5)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_5);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_5;
                        }
                        ?>
                    </td>
                    <td><?php if(isset($getkegiatan->detail->sumber_dana))echo $getkegiatan->detail->sumber_dana;?></td>
                    <td><?php if(isset($getkegiatan->detail->catatan_penting))echo $getkegiatan->detail->catatan_penting;?></td>
                    <td>
                        <?php 
                        if($kode == 0 && isset($getkegiatan->detail->prakiraan_target1))echo $getkegiatan->detail->prakiraan_target1;
                        elseif($kode == 1 && isset($getkegiatan->detail->prakiraan_target2)) echo $getkegiatan->detail->prakiraan_target2;
                        elseif($kode == 2 && isset($getkegiatan->detail->prakiraan_target3)) echo $getkegiatan->detail->prakiraan_target3;
                        elseif($kode == 3 && isset($getkegiatan->detail->prakiraan_target4)) echo $getkegiatan->detail->prakiraan_target4;
                        elseif($kode == 4 && isset($getkegiatan->detail->prakiraan_target5)) echo $getkegiatan->detail->prakiraan_target5;
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($kode == 0 && isset($getkegiatan->detail->prakiraan_pagu1)){
                            echo number_format($getkegiatan->detail->prakiraan_pagu1);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu1;
                        }
                        elseif($kode == 1 && isset($getkegiatan->detail->prakiraan_pagu2)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu2);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu2;
                        }
                        elseif($kode == 2 && isset($getkegiatan->detail->prakiraan_pagu3)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu3);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu3;
                        }
                        elseif($kode == 3 && isset($getkegiatan->detail->prakiraan_pagu4)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu4);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu4;
                        }
                        elseif($kode == 4 && isset($getkegiatan->detail->prakiraan_pagu5)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu5);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu5;
                        }
                        ?>
                    </td>
                </tr>
                @endforeach
            @endforeach
        
        @endif
        @endforeach

        <?php $i=0; ?>
        @foreach($renja as $pilihan)
        @if($pilihan->sts == 2)
        @if($i==0)
        <?php $i++;?>
        <tr>
            <td><b>2</b></td>
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
        @endif
        <tr>
            <td>2.{{$pilihan->kd_bidang}}</td>
            <td style="padding-left: 10px"><b>{{ucwords($pilihan->bidang)}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
            @foreach($pilihan->getprogram as $getprogram)
            <tr>
                <td>2.{{$pilihan->kd_bidang.'.'.$getprogram->kd_prog}}</td>
                <td style="padding-left: 20px"><b>{{ucwords($getprogram->program)}}</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                @foreach($getprogram->getkegiatan as $getkegiatan)
                <tr>
                    <td>2.{{$waj->kd_bidang.'.'.$getprogram->kd_prog.'.'.$getkegiatan->kd_kegiatan}}</td>
                    <td style="padding-left: 30px">{{ucwords($getkegiatan->nm_kegiatan)}}</td>
                    <td><?php if(isset($getkegiatan->detail->indikator_kinerja))echo $getkegiatan->detail->indikator_kinerja;?></td>
                    <td><?php if(isset($getkegiatan->detail->lokasi))echo $getkegiatan->detail->lokasi;?></td>
                    <td>
                        <?php 

                        if($kode == 0 && isset($getkegiatan->detail->target_capaian_1))echo $getkegiatan->detail->target_capaian_1;
                        elseif($kode == 1 && isset($getkegiatan->detail->target_capaian_2))echo $getkegiatan->detail->target_capaian_2;
                        elseif($kode == 2 && isset($getkegiatan->detail->target_capaian_3))echo $getkegiatan->detail->target_capaian_3;
                        elseif($kode == 3 && isset($getkegiatan->detail->target_capaian_4))echo $getkegiatan->detail->target_capaian_4;
                        elseif($kode == 4 && isset($getkegiatan->detail->target_capaian_5))echo $getkegiatan->detail->target_capaian_5;
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($kode == 0 && isset($getkegiatan->detail->pagu_indikatif_1)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_1);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_1;
                        }
                        elseif($kode == 1 && isset($getkegiatan->detail->pagu_indikatif_2)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_2);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_2;
                        }
                        elseif($kode == 2 && isset($getkegiatan->detail->pagu_indikatif_3)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_3);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_3;
                        }
                        elseif($kode == 3 && isset($getkegiatan->detail->pagu_indikatif_4)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_4);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_4;
                        }
                        elseif($kode == 4 && isset($getkegiatan->detail->pagu_indikatif_5)){
                            echo number_format($getkegiatan->detail->pagu_indikatif_5);
                            $jumlah_pagu_awal+=$getkegiatan->detail->pagu_indikatif_5;
                        }
                        ?>
                    </td>
                    <td><?php if(isset($getkegiatan->detail->sumber_dana))echo $getkegiatan->detail->sumber_dana;?></td>
                    <td><?php if(isset($getkegiatan->detail->catatan_penting))echo $getkegiatan->detail->catatan_penting;?></td>
                    <td>
                        <?php 
                        if($kode == 0 && isset($getkegiatan->detail->prakiraan_target1))echo $getkegiatan->detail->prakiraan_target1;
                        elseif($kode == 1 && isset($getkegiatan->detail->prakiraan_target2)) echo $getkegiatan->detail->prakiraan_target2;
                        elseif($kode == 2 && isset($getkegiatan->detail->prakiraan_target3)) echo $getkegiatan->detail->prakiraan_target3;
                        elseif($kode == 3 && isset($getkegiatan->detail->prakiraan_target4)) echo $getkegiatan->detail->prakiraan_target4;
                        elseif($kode == 4 && isset($getkegiatan->detail->prakiraan_target5)) echo $getkegiatan->detail->prakiraan_target5;
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($kode == 0 && isset($getkegiatan->detail->prakiraan_pagu1)){
                            echo number_format($getkegiatan->detail->prakiraan_pagu1);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu1;
                        }
                        elseif($kode == 1 && isset($getkegiatan->detail->prakiraan_pagu2)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu2);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu2;
                        }
                        elseif($kode == 2 && isset($getkegiatan->detail->prakiraan_pagu3)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu3);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu3;
                        }
                        elseif($kode == 3 && isset($getkegiatan->detail->prakiraan_pagu4)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu4);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu4;
                        }
                        elseif($kode == 4 && isset($getkegiatan->detail->prakiraan_pagu5)) {
                            echo number_format($getkegiatan->detail->prakiraan_pagu5);
                            $jumlah_pagu_akhir+=$getkegiatan->detail->prakiraan_pagu5;
                        }
                        ?>
                    </td>
                </tr>
                @endforeach
            @endforeach
        
        @endif
        @endforeach

        <tr>
            <th colspan='5'>Jumlah</th>
            <th>Rp.{{number_format($jumlah_pagu_awal)}}</th>
            <th colspan="3"></th>
            <th>Rp.{{number_format($jumlah_pagu_akhir)}}</th>
        </tr>

    </tbody>
</table>