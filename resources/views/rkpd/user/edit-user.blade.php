@extends('admin.index')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tambah User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li>
                <a href="{{url('administrator/user')}}">Master User</a>
            </li>
            <li class="active">
                <strong>Edit User</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @if (session('pesan'))
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                GAGAL : {{session('pesan')}}
            </div>
            @endif
            <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>TAMBAH USER</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('administrator/user/edit')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama</label>

                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}"> 
                                    <span class="help-block m-b-none">Isikan minimal 6 karakter.</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control">
                                    <span class="help-block m-b-none">Isikan untuk mengganti password dan minimal 6 karakter.</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Konfirmasi Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="konfirmasi">
                                    <span class="help-block m-b-none">Isikan untuk mengganti password dan minimal 6 karakter.</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <div class="i-checks">
                                        <label> <input type="radio" name="status" value="terbuka" <?php if($user->status == 'terbuka')echo "checked";?>> <i></i> Terbuka</label>
                                    </div>
                                    <div class="i-checks">
                                        <label> <input type="radio" name="status" value="terkunci" <?php if($user->status == 'terkunci')echo "terkunci";?>> <i></i> Terkunci </label>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" type="reset">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Save changes</button>
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