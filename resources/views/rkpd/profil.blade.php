@extends('rkpd.index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profil</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('rkpd/administrator')}}">Beranda</a>
            </li>
            <li class="active">
                <strong>Profil</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <form method="post" class="form-horizontal" action="{{url('rkpd/administrator/profil')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-12">
                @if (session('peringatan'))
                <div class="alert alert-danger">
                    {{session('peringatan')}}
                </div>
                @endif
                @if (session('pesan'))
                <div class="alert alert-success">
                    {{session('pesan')}}
                </div>
                @endif
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ganti Password</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password Lama</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="lama" minlength="6" maxlength="32" required> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password Baru</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="baru" minlength="6" maxlength="32" required> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Konfirmasi Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="konfirmasi" minlength="6" maxlength="32" required> 
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