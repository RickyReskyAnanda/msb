@extends('rkpd.index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Input Perkiraan Maju</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li>
                <a href="{{url('administrator/laporan-renja')}}">Laporan Renja</a>
            </li>
            <li class="active">
                <strong>Input Perkiraan Maju</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <form method="post" class="form-horizontal" action="{{url('rkpd/administrator/anggaran-perubahan/input')}}">
        {{csrf_field()}}
        <input type="hidden" name="id_rkpd" value="{{$detail->id_rkpd}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Kegiatan : {{$detail->nm_kegiatan}}</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Perubahan Target Kinerja Kuantitatif</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="target" value="{{$detail->hak_target_capaian}}" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan" value="{{$detail->satuan}}" required> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Perubahan Anggaran</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="pagu" value="{{$detail->hak_pagu_indikatif}}" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="3" name="keterangan" required></textarea> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    
    <div class="footer">
        <div>
            <strong>Copyright</strong> BAPPEDA KABUPATEN YALIMO
        </div>
    </div>
</div>
@endsection