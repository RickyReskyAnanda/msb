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

@foreach($data as $skpd)    
<table border="1px">
    <thead>
        <tr>
            <th colspan="8" style="text-align: center;">RINCIAN TAHUN ANGGARAN {{$tahun}} <br> KABUPATEN YALIMO</th>
        </tr>
        <tr>
            <th colspan="4">Nama SKPD : {{$skpd->skpd->nm_skpd}}</th>
            <th colspan="4" style="text-align: right;">Jumlah (tambah/kurang) : Rp<?php
                $jumlahtk = 0;
                foreach($skpd->bidang as $bidang)
                    foreach($bidang->program as $program)
                        foreach($program->kegiatan as $kegiatan)
                            $jumlahtk+=$kegiatan->tambah_kurang;
                echo number_format($jumlahtk);
            ?></th>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: center; vertical-align: middle;">Kode</th>
            <th rowspan="2" style="text-align: center; vertical-align: middle;">Urusan/Program/Kegiatan</th>
            <th colspan="2" style="text-align: center;">Sebelum Perubahan</th>
            <th colspan="2" style="text-align: center;">Setelah Perubahan</th>
            <th rowspan="2" style="text-align: center; vertical-align: middle;">Bertambah/Berkurang</th>
            <th rowspan="2" style="text-align: center; vertical-align: middle;">Keterangan</th>
        </tr>
        <tr>
            <th style="text-align: center;">Target Kinerja Kuantitatif</th>
            <th style="text-align: center;">Anggaran</th>
            <th style="text-align: center;">Target Kinerja Kuantitatif</th>
            <th style="text-align: center;">Anggaran</th>
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
            <td><b></b></td>
            <td></td>
            <td></td>
        </tr>
        <?php } ?>
        <tr>
            <td><b>01.{{$bidang->bidang->kode_bidang}}</b></td>
            <td><b>{{$bidang->bidang->bidang}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>01.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}</b></td>
            <td><b>{{$skpd->skpd->nm_skpd}}</b></td>
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
            <td style="text-align: right;">
                <?php
                $totalProgram=0;
                foreach($program->kegiatan as $kegiatan){
                    $totalProgram+=$kegiatan->hak_pagu_indikatif;
                }
                echo "Rp. ".number_format($totalProgram);
                ?>

            </td>
            <td></td>
            <td style="text-align: right;">
                <?php
                $totalProgram=0;
                foreach($program->kegiatan as $kegiatan){
                    $totalProgram+=$kegiatan->anggaran;
                }
                echo "Rp. ".number_format($totalProgram);
                ?>

            </td>
            <td style="text-align: right;">
                <?php
                $totalProgram=0;
                foreach($program->kegiatan as $kegiatan){
                    $totalProgram+=$kegiatan->tambah_kurang;
                }
                echo "Rp. ".number_format($totalProgram);
                ?>

            </td>
            <td></td>
        </tr>
        <?php $kode = 1;?>
        @foreach($program->kegiatan as $kegiatan)
        <tr>
            <td><b>01.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}.{{$kode++}}</b></td>
            <td>{{$kegiatan->nm_kegiatan}}</td>
            <td>{{$kegiatan->hak_target_capaian.' '.$kegiatan->satuan}}</td>
            <td style="text-align: right">Rp. {{number_format($kegiatan->hak_pagu_indikatif)}}</td>
            <td>{{$kegiatan->target.' '.$kegiatan->satuan_ap}}</td>
            <td style="text-align: right">Rp. {{number_format($kegiatan->anggaran)}}</td>
            <td style="text-align: right">Rp. {{number_format($kegiatan->tambah_kurang)}}</td>
            <td>{{$kegiatan->ket}}</td>
        </tr>
        @endforeach
        @endforeach
        @endif
        @endforeach


        
        <?php $pilihan = 0?>
        @foreach($skpd->bidang as $bidang)
        @if($bidang->bidang->sts == '2')
        <?php $pilihan++;
        if($pilihan == 1){
        ?>
        <tr>
            <td style="text-align: left"><b>02</b></td>
            <td><b>Pilihan</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b></b></td>
            <td></td>
            <td></td>
        </tr>
        <?php } ?>
        <tr>
            <td style="text-align: left"><b>02.{{$bidang->bidang->kode_bidang}}</b></td>
            <td><b>{{$bidang->bidang->bidang}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align: left"><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}</b></td>
            <td><b>{{$skpd->skpd->nm_skpd}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($bidang->program as $program)
        <tr>
            <td style="text-align: left"><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}</b></td>
            <td><b>{{$program->program->program}}</b></td>
            <td></td>
            <td style="text-align: right;"><?php
                $totalProgram=0;
                foreach($program->kegiatan as $kegiatan){
                    $totalProgram+=$kegiatan->hak_pagu_indikatif;
                }
                echo "Rp. ".number_format($totalProgram);
                ?></td>
            <td></td>
            <td style="text-align: right;">
                <?php
                $totalProgram=0;
                foreach($program->kegiatan as $kegiatan){
                    $totalProgram+=$kegiatan->anggaran;
                }
                echo "Rp. ".number_format($totalProgram);
                ?>

            </td>
            <td style="text-align: right;">
                <?php
                $totalProgram=0;
                foreach($program->kegiatan as $kegiatan){
                    $totalProgram+=$kegiatan->tambah_kurang;
                }
                echo "Rp. ".number_format($totalProgram);
                ?>

            </td>
            <td></td>
        </tr>
        <?php $kode = 1;?>
        @foreach($program->kegiatan as $kegiatan)
        <tr>
            <td style="text-align: left"><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}.{{$kode++}}</b></td>
            <td>{{$kegiatan->nm_kegiatan}}</td>
            <td>{{$kegiatan->hak_target_capaian.' '.$kegiatan->satuan}}</td>
            <td style="text-align: right">Rp. {{number_format($kegiatan->hak_pagu_indikatif)}}</td>
            <td>{{$kegiatan->target.' '.$kegiatan->satuan_ap}}</td>
            <td style="text-align: right">Rp. {{number_format($kegiatan->anggaran)}}</td>
            <td style="text-align: right">Rp. {{number_format($kegiatan->tambah_kurang)}}</td>
            <td>{{$kegiatan->ket}}</td>
        </tr>
        @endforeach
        @endforeach
        @endif
        @endforeach
    </tbody>
</table>
@endforeach