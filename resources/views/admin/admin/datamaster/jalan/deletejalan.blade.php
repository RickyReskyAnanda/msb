@extends('admin.index')

@section('content')
<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                <div class="card yellow darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Apakah Anda ingin menghapus data Jalan ?</span>
                        <p>Setelah data terhapus, data tidak dapat dikembalikan !</p>
                    </div>
                    <div class="card-action right">
                        <a href="{{url('administrator/data-master/jalan/delete/'.$id)}}" class="red-text">Hapus Jalan</a>
                        <a href="{{url('administrator/data-master/jalan')}}" class="black-text">Batalkan</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end container-->
@endsection