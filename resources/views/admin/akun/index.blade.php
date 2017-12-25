@extends('admin.index')

@section('content')
<section class="content container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pengaturan Akun</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- form start -->
          @if (session('password'))
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p><i class="icon fa fa-warning"></i> {{ session('password') }}</p>
            </div>
          @endif
          @if (session('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p>{{ session('success') }}</p>
            </div>
          @endif
          <form class="form-horizontal" action="<?=url('administrator/akun')?>" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" maxlength="32" value="<?=$data->name?>" placeholder="Masukkan Nama.." required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Username</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" name="username" minlength="8" maxlength="32" value="<?=$data->username?>" placeholder="Masukkan Username.." required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-9">
                <input type="password" class="form-control" minlength="8" maxlength="32" name="password" value="{{ old('password') }}" placeholder="Masukkan Password..">
                * Masukkan Password baru untuk mengganti
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Konfirmasi Password</label>

              <div class="col-sm-9">
                <input type="password" class="form-control" minlength="8" maxlength="32" name="confirm" placeholder="Konfirmasi Password..">
                * Masukkan Kembali Password untuk mengganti password
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger" style="margin-bottom: 50px ">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection