@extends('admin.index')

@section('content')
<!--start container-->
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="card  light-blue">
                    <div class="card-content white-text">
                        <span class="card-title">Selamat datang</span>
                        <p>Disini Anda dapat melihat usulan-usulan yang masuk, yang disetujui, maupun yang ditolak pada kegiatan Musrenbang 2017 Kabupaten Yalimo.</p> 
                        <p>Apabila Anda adalah warga Kabupaten Yalimo yang ingin berperan serta dan ingin memberikan usulan, dapat melalui kampung tempat anda tinggal.</p> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                @if (session('aksesmasuk'))
                <div id="card-alert" class="card orange">
                      <div class="card-content white-text">
                        <p><i class="mdi-alert-warning"></i> WARNING : {{session('aksesmasuk')}}</p>
                      </div>
                      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                @endif
                <div id="task-card" class="collection with-header">
                  <div class="collection-header cyan">
                      <h6 class="task-card-title">Login sebagai Kampung, Distrik ,SKPD, Bappeda, Admin</h6>
                  </div>
                  <div class="collection-item dismissable">
                       <form method="post" action="{{url('login')}}" class="formValidate" id="formlogin">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </div>
                      </form> 
                  </div>
              </div>
            </div>
            <div class="col s6">
                <div class="card  light-blue">
                    <div class="card-content white-text">
                      <span class="card-title">Keterangan Daftar User Login</span>
                      <p>
                        <b>User Kampung :</b>
                        <br>User dari pihak kampung, berperan untuk memasukkan usulan yang akan di buat di Kampung
                      </p>
                      <p>
                        <b>User Distrik :</b>
                        <br>User dari pihak Distrik, berperan untuk memasukkan usulan yang dibuat kampung ke SKPD
                      </p>
                      <p>
                        <b>User SKPD :</b>
                        <br>User dari pihak SKPD, berperan untuk melakukan verifikasi usulan yang masuk dari Distrik
                      </p>
                      <p>
                        <b>User Bappeda :</b>
                        <br>User dari pihak Bappeda, berperan untuk mengontrol user, dan usulan serta melakukan monitoring
                      </p>
                    </div>
                </div>
            </div>

          
        </div>
    </div>
</div>
<!--end container-->
@endsection