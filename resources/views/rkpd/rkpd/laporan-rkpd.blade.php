@extends('admin.index')

@section('content')
<style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 4px;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Laporan RKPD</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li class="active">
                <strong>Laporan RKPD</strong>
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
                        <form method="get" action="{{url('administrator/laporan-rkpd')}}">
                            <div class="col-md-9">
                                <select name="skpd" class="form-control" required>
                                    <option value="" disabled selected="">Pilih SKPD</option>
                                    <?php $i=0;
                                    foreach($skpd as $skpd1){
                                    ?>
                                    <option value="{{$skpd1->id_skpd}}" <?php if(isset($request->skpd) && $skpd1->id_skpd == $request->skpd)echo "selected"; ?>>{{$skpd1->nm_skpd}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Cari Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Laporan RKPD</h5>
                </div>
                <div class="ibox-content">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            @for($i=0;$i<5;$i++)
                            <li class="<?php if($i==0)echo "active";?>"><a data-toggle="tab" href="#tab-{{$i}}"> Tahun {{$tahun+$i}}</a></li>
                            @endfor
                        </ul>
                        <div class="tab-content">
                            @for($i=0;$i<5;$i++)

                            <?php   $jumlah_pagu_awal=0;
                                    $jumlah_pagu_akhir=0;
                            ?>
                            <div id="tab-{{$i}}" class="tab-pane <?php if($i==0)echo "active";?>">
                                <div class="panel-body">
                                @if(isset($request->skpd))
                                <a href="{{url('administrator/excel-rkpd/'.$request->skpd.'/'.$i)}}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Report Excel RKPD {{$tahun+$i}}</a>
                                @endif
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
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
                                                <td>{{($nomor-1).'.'.$nomor2++}}</td>
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
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>


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