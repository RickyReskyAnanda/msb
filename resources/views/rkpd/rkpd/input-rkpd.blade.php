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
    <form method="post" class="form-horizontal" action="{{url('rkpd/administrator/input-rkpd')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>INPUT RKPD</h5>
                    </div>
                    <div class="ibox-content">
                        <?php if(isset($id_usul_bappeda)){?>
                        <input type="hidden" name="id_usul_bappeda" value="{{$id_usul_bappeda}}">
                        <?php } ?>
                        <input type="hidden" name="sts_rkpd" value="{{$jenis}}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tahun</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="tahun_rkpd" required>
                                    @for($i=0;$i<5;$i++)
                                    <option value="{{$tahun+$i}}" <?php if(($tahun+$i) == date('Y'))echo "selected";?>>{{$tahun+$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">SKPD Pelaksana</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="skpd" required>
                                    <option value="" disabled selected>Pilih SKPD Pelaksana</option>
                                    @foreach($skpd as $skp)
                                    <option value="{{$skp->id_skpd}}">{{$skp->nm_skpd}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Bidang Urusan</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="bidang" required>
                                    <option value="" disabled selected>Pilih Bidang</option>
                                    @foreach($bidang as $bdg)
                                    <option value="{{$bdg->id_bidang}}">{{$bdg->bidang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Program</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="program" required>
                                    <option value="" disabled selected>Pilih Program</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_kegiatan"  required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lokasi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lokasi"  required> 
                                <span class="help-block m-b-none">Pisahkan lokasi dengan koma(,)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Satuan</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="satuan" required>
                                    <option value="" disabled selected>Pilih Satuan</option>
                                    @foreach($satuan as $stn)
                                    <option value="{{$stn->satuan}}">{{$stn->satuan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Indikator Kinerja</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="indikator_kinerja" required> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Target Capaian</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="target_capaian"  required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pagu Indikatif</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="pagu_indikatif"  required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Sumber Dana</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="sumber_dana" required>
                                    <option value="" disabled selected>Pilih Sumber Dana</option>
                                    @foreach($sumberDana as $sumber)
                                    <option value="{{$sumber->sumber_dana}}">{{$sumber->sumber_dana}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>HASIL ANALISIS KEBUTUHAN</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lokasi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="hak_lokasi" value="" required> 
                                <span class="help-block m-b-none">Pisahkan lokasi dengan koma(,)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Target Capaian</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="hak_target_capaian" value="" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pagu Indikatif</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="hak_pagu_indikatif" value="" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Catatan Penting</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="catatan_penting" placeholder="Masukkan catatan penting" required></textarea> 
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
                                <input type="number" class="form-control" name="prakiraan_target" value="" required> 
                                <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Prakiraan Pagu</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="prakiraan_pagu" value="" required> 
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