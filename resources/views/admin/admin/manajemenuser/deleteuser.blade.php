@extends('admin.index')

@section('content')
<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                <div class="card yellow darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Apakah anda ingin menghapus user ?</span>
                        <p>Setelah data terhapus, data tidak dapat dikembalikan !</p>
                    </div>
                    <div class="card-action right">
                        <a href="{{url('administrator/manajemen-user/delete/'.$id.'/'.$level)}}" class="white-text">Hapus User</a>
                        <a href="{{url('administrator/manajemen-user/'.$level)}}" class="white-text">Batalkan</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end container-->
@endsection