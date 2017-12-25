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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>TAMBAH USER</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('administrator/laporan-renja/edit')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$rkpd->id_rkpd}}" name="id_rkpd">
                            <input type="hidden" value="{{$kode}}" name="kode">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Target Capaian Kinerja</label>
                                <?php   
                                    $target='';
                                    $dana='';
                                    if($kode==0){
                                        $target = $rkpd->prakiraan_target1;
                                        $dana   = $rkpd->prakiraan_pagu1;
                                    }
                                    elseif($kode==1){
                                        $target = $rkpd->prakiraan_target2;
                                        $dana   = $rkpd->prakiraan_pagu2;
                                    }
                                    elseif($kode==2){
                                        $target = $rkpd->prakiraan_target3;
                                        $dana   = $rkpd->prakiraan_pagu3;
                                    }
                                    elseif($kode==3){
                                        $target = $rkpd->prakiraan_target4;
                                        $dana   = $rkpd->prakiraan_pagu4;
                                    }
                                    elseif($kode==4){
                                        $target = $rkpd->prakiraan_target5;
                                        $dana   = $rkpd->prakiraan_pagu5;
                                    }
                                ?>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="target" value="{{$target}}" require>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kebutuhan Dana/ pagu indikatif</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="dana" value="{{$dana}}" required> 
                                    <span class="help-block m-b-none">Isikan dengan angka tanpa koma(,) atau titik(.)</span>
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
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