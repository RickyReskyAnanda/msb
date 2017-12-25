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
                <strong>Anggaran Perubahan</strong>
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
                        <form method="get" action="{{url('rkpd/administrator/anggaran-perubahan')}}">
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
                                    <option value="<?= $tahun_p+$i ?>" <?php if(($tahun_p+$i) == $tahun)echo "selected";?>>{{$tahun_p+$i}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" name="simpan" value="cari"><i class="fa fa-plus"></i> Cari Laporan</button>
                                <button type="submit" class="btn btn-primary" name="laporan" value="cetak"><i class="fa fa-file-excel-o"></i> Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Anggaran Perubahan</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    @foreach($data as $skpd)   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="8" style="text-align: center;">RINCIAN TAHUN ANGGARAN 2013 <br> KABUPATEN YALIMO</th>
                                <th rowspan="4" style="text-align: center; vertical-align: middle;">Pengesahan</th>
                                <th rowspan="4" style="text-align: center; vertical-align: middle;">Aksi</th>
                            </tr>
                            <tr>
                                <th colspan="4">Nama SKPD : {{$skpd->skpd->nm_skpd}}</th>
                                <th colspan="4" style="text-align: right;">Jumlah (tambah/kurang) : Rp7.500.050.000</th>
                            </tr>
                            <tr>
                                <th rowspan="2" style="text-align: center;">Kode</th>
                                <th rowspan="2" style="text-align: center;">Urusan/Program/Kegiatan</th>
                                <th colspan="2" style="text-align: center;">Sebelum Perubahan</th>
                                <th colspan="2" style="text-align: center;">Setelah Perubahan</th>
                                <th rowspan="2" style="text-align: center;">Bertambah/Berkurang</th>
                                <th rowspan="2" style="text-align: center;">Keterangan</th>
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
                                <td><b></b></td>
                                <td></td>
                                <td></td>
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
                                <td></td>
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
                                <td><button class="btn btn-warning" data-id="{{$kegiatan->id_rkpd}}" <?php if($kegiatan->sah_ap == 'YA')echo "disabled='disabled'";?>>SAH</button></td>
                                <td>
                                    <?php if($kegiatan->sah_ap != 'YA'){?>
                                    <a href="{{url('rkpd/administrator/anggaran-perubahan/edit/'.$kegiatan->id_rkpd)}}" class="btn btn-primary edit" data-id="{{$kegiatan->id_rkpd}}"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('rkpd/administrator/anggaran-perubahan/hapus/'.$kegiatan->id_rkpd)}}" class="btn btn-danger hapus" data-id="{{$kegiatan->id_rkpd}}"><i class="fa fa-trash"></i></a>
                                    <?php }?>
                                </td>
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
                                <td><b>02</b></td>
                                <td><b>Pilihan</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b></b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td><b>02.{{$bidang->bidang->kode_bidang}}</b></td>
                                <td><b>{{$bidang->bidang->bidang}}</b></td>
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
                                <td><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}</b></td>
                                <td><b>{{$skpd->skpd->nm_skpd}}</b></td>
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
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $kode = 1;?>
                            @foreach($program->kegiatan as $kegiatan)
                            <tr>
                                <td><b>02.{{$bidang->bidang->kode_bidang}}.{{$skpd->skpd->kode}}.{{$program->program->kd_prog}}.{{$kode++}}</b></td>
                                <td>{{$kegiatan->nm_kegiatan}}</td>
                                <td>{{$kegiatan->hak_target_capaian.' '.$kegiatan->satuan}}</td>
                                <td style="text-align: right">Rp. {{number_format($kegiatan->hak_pagu_indikatif)}}</td>
                                <td>{{$kegiatan->target.' '.$kegiatan->satuan_ap}}</td>
                                <td style="text-align: right">Rp. {{number_format($kegiatan->anggaran)}}</td>
                                <td style="text-align: right">Rp. {{number_format($kegiatan->tambah_kurang)}}</td>
                                <td>{{$kegiatan->ket}}</td>
                                <td><button class="btn btn-warning pengesahan" data-id="{{$kegiatan->id_rkpd}}" <?php if($kegiatan->sah_ap == 'YA')echo "disabled='disabled'";?>>SAH</button></td>
                                <td>
                                    <?php if($kegiatan->sah_ap != 'YA'){?>

                                    <a href="{{url('rkpd/administrator/anggaran-perubahan/edit/'.$kegiatan->id_rkpd)}}" class="btn btn-primary edit" data-id="{{$kegiatan->id_rkpd}}"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('rkpd/administrator/anggaran-perubahan/hapus/'.$kegiatan->id_rkpd)}}" class="btn btn-danger hapus" data-id="{{$kegiatan->id_rkpd}}"><i class="fa fa-trash"></i></a>
                                    <?php }?>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
                    @if(count($data)<1)
                        <h3 style="text-align: center">Data Tidak Ada !</h3>
                    @endif
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
        $.get("{{url('rkpd/administrator/anggaran-perubahan/pengesahan')}}/"+identitas,function(data, status){
            $('button[data-id='+identitas+']').attr('disabled','disabled');
            $('.edit[data-id='+identitas+']').remove();
            $('.hapus[data-id='+identitas+']').remove();
            alert('data telah disahkan');
            console.log(data);
        });
    });
</script>
@endsection