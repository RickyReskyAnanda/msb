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

<table border=1>
    <thead>
        <tr>
            <th colspan="12"><h2 align="center">Review Terhadap Rancangan RKPD Tahun {{$tahun+$i}}</h2></th>
        </tr>
        <tr>
            <th colspan="12"><h2 align="center">Kabupaten Yalimo</h2></th>
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
        <?php $nomor=1;?>
        @foreach($program as $prog)
        <tr>
            <td><b>{{$nomor++}}</b></td>
            <td><b>{{ucwords($prog->program->program)}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>{{ucwords($prog->program->program)}}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php $nomor2=1;?>
        @foreach($prog->rkpd as $kegiatan)
            <?php 

            $haki=array();
            $haki[$i] = 0;
            foreach ($kegiatan->hak as $hak){
                    if($hak->tahun == $tahun+$i)$haki[$i]++;
                }?>
        <tr>
            <td><?=($nomor-1).'.'.$nomor2++;?></td>
            <td>{{ucwords($kegiatan->kegiatan->nm_kegiatan)}}</td>
            <td><?php if(isset($kegiatan->lokasi))echo $kegiatan->lokasi;?></td>
            <td><?php if(isset($kegiatan->indikator_kinerja))echo $kegiatan->indikator_kinerja;?></td>
            <td>
                <?php
                    if($i == 0 && isset($kegiatan->target_capaian_1))echo $kegiatan->target_capaian_1;
                    elseif($i == 1 && isset($kegiatan->target_capaian_2))echo $kegiatan->target_capaian_2;
                    elseif($i == 2 && isset($kegiatan->target_capaian_3))echo $kegiatan->target_capaian_3;
                    elseif($i == 3 && isset($kegiatan->target_capaian_4))echo $kegiatan->target_capaian_4;
                    elseif($i == 4 && isset($kegiatan->target_capaian_5))echo $kegiatan->target_capaian_5;
                ?>
            </td>
            <td>
                <?php 
                    if($i == 0 && isset($kegiatan->pagu_indikatif_1)){
                        echo number_format($kegiatan->pagu_indikatif_1);
                        $jumlah_pagu_awal +=$kegiatan->pagu_indikatif_1;
                    }
                    elseif($i == 1 && isset($kegiatan->pagu_indikatif_2)){
                        echo number_format($kegiatan->pagu_indikatif_2);
                        $jumlah_pagu_awal +=$kegiatan->pagu_indikatif_2;
                    }
                    elseif($i == 2 && isset($kegiatan->pagu_indikatif_3)){
                        echo number_format($kegiatan->pagu_indikatif_3);
                        $jumlah_pagu_awal +=$kegiatan->pagu_indikatif_3;
                    }
                    elseif($i == 3 && isset($kegiatan->pagu_indikatif_4)){
                        echo number_format($kegiatan->pagu_indikatif_4);
                        $jumlah_pagu_awal +=$kegiatan->pagu_indikatif_4;
                    }
                    elseif($i == 4 && isset($kegiatan->pagu_indikatif_5)){
                        echo number_format($kegiatan->pagu_indikatif_5);
                        $jumlah_pagu_awal +=$kegiatan->pagu_indikatif_5;
                    }
                ?>
            </td>
            <td>{{ucwords($kegiatan->kegiatan->nm_kegiatan)}}</td>
            <td>
                <?php
                    if($haki[$i]>0){

                        $inc=0;
                        foreach ($kegiatan->hak as $hak) {
                            if($hak->tahun == $tahun+$i)
                            if($inc==0){
                                echo ucwords($hak->lokasi);
                                $inc++;
                            }
                            else echo ', '.ucwords($hak->lokasi);
                        }
                    }else{
                        if(isset($kegiatan->lokasi))echo $kegiatan->lokasi;
                    }
                ?>
            </td>
            <td><?php if(isset($kegiatan->indikator_kinerja))echo ucwords($kegiatan->indikator_kinerja);?></td>
            <td>
                <?php
                    if($haki[$i]>0){
                        $jumlah = 0;
                        foreach ($kegiatan->hak as $hak) {
                            if($hak->tahun == $tahun+$i){
                                $jumlah+= $hak->target_capaian;
                            }
                        }
                        echo $jumlah;
                    }else{
                         if($i == 0 && isset($kegiatan->target_capaian_1))echo $kegiatan->target_capaian_1;
                        elseif($i == 1 && isset($kegiatan->target_capaian_2))echo $kegiatan->target_capaian_2;
                        elseif($i == 2 && isset($kegiatan->target_capaian_3))echo $kegiatan->target_capaian_3;
                        elseif($i == 3 && isset($kegiatan->target_capaian_4))echo $kegiatan->target_capaian_4;
                        elseif($i == 4 && isset($kegiatan->target_capaian_5))echo $kegiatan->target_capaian_5;
                    }
                ?>
            </td>
            <td>
                <?php
                    if($haki[$i]>0){
                    
                        $jumlah = 0;
                        foreach ($kegiatan->hak as $hak) {
                            if($hak->tahun == $tahun+$i){
                                $jumlah+= $hak->pagu_indikatif;
                            }
                        }
                        echo number_format($jumlah);
                        $jumlah_pagu_akhir+=$jumlah;
                    }else{
                        if($i == 0 && isset($kegiatan->pagu_indikatif_1)){
                            echo number_format($kegiatan->pagu_indikatif_1);
                            $jumlah_pagu_akhir +=$kegiatan->pagu_indikatif_1;
                        }
                        elseif($i == 1 && isset($kegiatan->pagu_indikatif_2)){
                            echo number_format($kegiatan->pagu_indikatif_2);
                            $jumlah_pagu_akhir +=$kegiatan->pagu_indikatif_2;
                        }
                        elseif($i == 2 && isset($kegiatan->pagu_indikatif_3)){
                            echo number_format($kegiatan->pagu_indikatif_3);
                            $jumlah_pagu_akhir +=$kegiatan->pagu_indikatif_3;
                        }
                        elseif($i == 3 && isset($kegiatan->pagu_indikatif_4)){
                            echo number_format($kegiatan->pagu_indikatif_4);
                            $jumlah_pagu_akhir +=$kegiatan->pagu_indikatif_4;
                        }
                        elseif($i == 4 && isset($kegiatan->pagu_indikatif_5)){
                            echo number_format($kegiatan->pagu_indikatif_5);
                            $jumlah_pagu_akhir +=$kegiatan->pagu_indikatif_5;
                        }
                    }
                ?>
            </td>
            <td><?php if(isset($kegiatan->catatan_penting))echo $kegiatan->catatan_penting?></td>
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
    </tfoot>
</table>