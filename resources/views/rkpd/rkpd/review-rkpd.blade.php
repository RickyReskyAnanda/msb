@extends('rkpd.index')

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
            @if (session('pesan'))
            <div class="alert alert-success">
                {{session('pesan')}}
            </div>
            @endif
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Filter SKPD</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form method="get" action="{{url('rkpd/administrator/review-rkpd')}}">
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
                                    <option value="<?= $tahun+$i ?>" <?php if(($tahun+$i) == $tahun)echo "selected";?>>{{$tahun+$i}}</option>
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
                    <div class="table-responsive">
                    @foreach($data as $skpd)    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">SKPD Pelaksana</th>
                                <th colspan="12"><?php if(isset($skpd->skpd->nm_skpd))echo $skpd->skpd->nm_skpd;?></th>
                            </tr>
                            <tr>
                                <th rowspan="2">No</th>
                                <th colspan="5">Rancangan Awal RKPD</th>
                                <th colspan="5">Hasil Analisis Kebutuhan</th>
                                <th rowspan="2">Catatan Penting</th>
                                <th rowspan="2">Pengesahan</th>
                                <th rowspan="2">Anggaran Perubahan</th>
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
                                <th>13</th>
                                <th>14</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor=1;
                                $jumlah_pagu_awal = 0;
                                $jumlah_pagu_akhir = 0;

                            ?>
                            
                            @foreach($skpd->program as $prog)
                            <tr>
                                <td><b>{{$nomor++}}</b></td>
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
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nomor2=1;?>
                            @foreach($prog->rkpd as $kegiatan)
                            <tr>
                                <td>{{($nomor-1).'.'.$nomor2++}}</td>
                                <td><?php if(isset($kegiatan->nm_kegiatan))echo ucwords($kegiatan->nm_kegiatan)?></td>
                                <td><?php if(isset($kegiatan->lokasi))echo $kegiatan->lokasi;?></td>
                                <td><?php if(isset($kegiatan->indikator_kinerja))echo $kegiatan->indikator_kinerja;?></td>
                                <td>{{$kegiatan->target}}</td>
                                <td>
                                    <?php 
                                        echo number_format($kegiatan->pagu_indikatif);
                                        $jumlah_pagu_awal +=$kegiatan->pagu_indikatif;
                                    ?>
                                </td>
                                <td>{{ucwords($kegiatan->nm_kegiatan)}}</td>
                                <td>{{$kegiatan->hak_lokasi}}</td>
                                <td><?php if(isset($kegiatan->indikator_kinerja))echo ucwords($kegiatan->indikator_kinerja);?></td>
                                <td>{{$kegiatan->hak_target_capaian}}</td>
                                <td><?php
                                        echo number_format($kegiatan->hak_pagu_indikatif);
                                        $jumlah_pagu_akhir +=$kegiatan->hak_pagu_indikatif;
                                    ?>
                                </td>
                                <td><?php if(isset($kegiatan->catatan_penting))echo $kegiatan->catatan_penting;?></td>
                                <td>
                                    <button class="btn btn-warning pengesahan" data-id="{{$kegiatan->id_rkpd}}" <?php if($kegiatan->sah == 'YA')echo "disabled='disabled'";?>>SAH</button>
                                </td>
                                <td>
                                    @if($kegiatan->sah =='YA')
                                    <a href="{{url('rkpd/administrator/anggaran-perubahan/input/'.$kegiatan->id_rkpd)}}" class="btn btn-primary">Anggaran Perubahan</a>
                                    @endif
                                </td>
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
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
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
<script type="text/javascript">
    $('.pengesahan').click(function(){
        var identitas = $(this).attr('data-id');
        $.get("{{url('rkpd/administrator/review-rkpd/pengesahan')}}/"+identitas,function(data, status){
            $('button[data-id='+identitas+']').attr('disabled','disabled');
            alert('data telah disahkan');
            console.log(data);
        });
    });
</script>
@endsection