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
                                    <option value="<?= $tahun_ap+$i ?>" <?php if(($tahun_ap+$i) == $tahun)echo "selected";?>>{{$tahun_ap+$i}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Cari </button>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">Kode</th>
                                <th rowspan="2">Urusan/Bidang Urusan Pemerintah Daerah dan Program/Kegiatan</th>
                                <th rowspan="2">Indikator Kinerja Program/Kegiatan</th>
                                <th colspan="4">Rencana Tahun 2018 (tahun rencana)</th>
                                <th rowspan="2">Catatan Penting</th>
                                <th colspan="2">Perkiraan Maju Rencana 2019</th>
                                <th rowspan="3">Edit Perkiraan Maju</th>
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
                            <tr>
                                <td><b>1</b></td>
                                <td><b>Wajib</b></td>
                                <td></td>
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
                                <td></td>
                                <td style="padding-left: 10px"><b></b></td>
                                <td></td>
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
                                <th colspan='5'>Jumlah</th>
                                <th>Rp.</th>
                                <th colspan="3"></th>
                                <th>Rp.</th>
                            </tr>

                        </tbody>
                    </table>
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