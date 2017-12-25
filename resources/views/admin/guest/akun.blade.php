@extends('admin.index')

@section('content')

<!--start container-->
<div class="container">
    <div class="section">
        <!--Form Advance-->          
        <div class="row">
            <div class="col s12 m12 l12">
                @if (session('pesan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-alert-warning"></i> WARNING : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                @if (session('gagal'))
                <div id="card-alert" class="card orange">
                    <div class="card-content white-text">
                        <p><i class="mdi-alert-warning"></i> WARNING : {{session('gagal')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <form class="col s12 formValidate" id="formakun" method="post"  action="{{url('akun')}}">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="old_pass">Password Lama</label>
                                    <input type="password" id="old_pass" name="old_pass" placeholder="Masukkan Password Lama" data-error=".errorTxt1">
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="new_pass">Password Baru</label>
                                    <input type="password" name="new_pass" id="new_pass" placeholder="Masukkan Password Baru" data-error=".errorTxt2">
                                    <div class="errorTxt2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="confirm_pass">Konfirmasi Password Baru</label>
                                    <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Masukkan Kembali Password Baru" data-error=".errorTxt3">
                                    <div class="errorTxt3"></div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit">Perbaharui Akun
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<!--end container-->
@endsection