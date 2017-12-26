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
            <th colspan="2">SKPD Pelaksana</th>
            <th colspan="10" style="text-align: left"><?php if(isset($skpd->skpd->nm_skpd))echo $skpd->skpd->nm_skpd;?></th>
        </tr>
        <tr>
            <th rowspan="2">No</th>
            <th colspan="5">Rancangan Awal RKPD</th>
            <th colspan="5">Hasil Analisis Kebutuhan</th>
            <th rowspan="2">Catatan Penting</th>
        </tr>
        <tr>
            <th>Program / Kegiatan</th>
            <th>Lokasi</th>
            <th>Indikator Kinerja</th>
            <th>Target Capaian</th>
            <th>Pagu Indikatif (Rp.000)</th>
            <th>Program / Kegiatan</th>
            <th>Lokasi</th>
            <th>Indikator Kinerja</th>
            <th>Target Capaian</th>
            <th>Pagu Indikatif (Rp.000)</th>
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
            <th>11</th>
            <th>12</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1;
            $jumlah_pagu_awal = 0;
            $jumlah_pagu_akhir = 0;

        ?>
        
        @foreach($skpd->program as $prog)
        <tr>
            <td style="text-align: left"><b>{{$nomor++}}</b></td>
            <td><b><?php if(isset($prog->program->program))echo ucwords($prog->program->program);?></b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b><?php if(isset($prog->program->program))echo ucwords($prog->program->program);?> </b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php $nomor2=1;?>
        @foreach($prog->rkpd as $kegiatan)
        <tr>
            <td style="text-align: left;">{{($nomor-1).'.'.$nomor2++}}</td>
            <td><?php if(isset($kegiatan->nm_kegiatan))echo ucwords($kegiatan->nm_kegiatan)?></td>
            <td><?php if(isset($kegiatan->lokasi))echo $kegiatan->lokasi;?></td>
            <td><?php if(isset($kegiatan->indikator_kinerja))echo $kegiatan->indikator_kinerja;?></td>
            <td>{{$kegiatan->target.' '.$kegiatan->satuan}}</td>
            <td>
                <?php 
                    echo number_format($kegiatan->pagu_indikatif);
                    $jumlah_pagu_awal +=$kegiatan->pagu_indikatif;
                ?>
            </td>
            <td>{{ucwords($kegiatan->nm_kegiatan)}}</td>
            <td>{{$kegiatan->hak_lokasi}}</td>
            <td><?php if(isset($kegiatan->indikator_kinerja))echo ucwords($kegiatan->indikator_kinerja);?></td>
            <td><?php if(isset($kegiatan->hak_target_capaian) || $kegiatan->hak_target_capaian!=0)
                        echo number_format($kegiatan->hak_target_capaian).' '.$kegiatan->satuan ?></td>
            <td><?php
                    if(isset($kegiatan->hak_target_capaian) || $kegiatan->hak_target_capaian!=0)
                    echo number_format($kegiatan->hak_pagu_indikatif);
                    $jumlah_pagu_akhir +=$kegiatan->hak_pagu_indikatif;
                ?>
            </td>
            <td><?php if(isset($kegiatan->catatan_penting))echo $kegiatan->catatan_penting;?></td>
        </tr>
        @endforeach
        @endforeach            
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Jumlah</th>
            <th>Rp.{{number_format($jumlah_pagu_awal)}}</th>
            <th colspan="4"></th>
            <th>Rp.{{number_format($jumlah_pagu_akhir)}}</th>
            <th></th>
        </tr>
        <tr>
            <td colspan="12" rowspan="2"></td>
        </tr>
    </tfoot>
</table>
@endforeach