@extends('rkpd.index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Hasil Ananlisis dan Prakiraan Maju</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li>
                <a href="{{url('administrator/laporan-renja')}}">Laporan Renja</a>
            </li>
            <li class="active">
                <strong>Edit Hasil Ananlisis dan Prakiraan Maju</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <form method="post" class="form-horizontal" action="{{url('rkpd/administrator/review-renstra/edit')}}">
        {{csrf_field()}}
        <input type="hidden" name="id_rkpd" value="{{$detail->id_rkpd}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>HASIL ANALISIS KEBUTUHAN</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lokasi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="hak_lokasi" value="{{$detail->hak_lokasi}}" required> 
                                <span class="help-block m-b-none">Pisahkan lokasi dengan koma(,)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Target Capaian</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="hak_target_capaian" value="{{$detail->hak_target_capaian}}" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pagu Indikatif</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="hak_pagu_indikatif" value="{{$detail->hak_pagu_indikatif}}" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Catatan Penting</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="catatan_penting" placeholder="Masukkan catatan penting" required>{{$detail->catatan_penting}}</textarea> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>PRAKIRAAN RENCANA MAJU TAHUN 2019</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Prakiraan Target</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="prakiraan_target" value="{{$detail->prakiraan_target}}" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Prakiraan Pagu</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="prakiraan_pagu" value="{{$detail->prakiraan_pagu}}" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
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
<script type="text/javascript">
    $('select[name=bidang]').change(function(){
        $.get("{{url('api/data/programbybidang')}}/"+$(this).val(),function(data, status){
            $('select[name=program]').html('<option value="" disabled selected>Pilih Program</optional>');

            if(data.length > 0){
                data.forEach(function(value,index){
                    $('select[name=program]').append('<option value="'+value.id_prog+'">'+value.program+'</option>');
                });
            }
        });
    });
</script>
@endsection