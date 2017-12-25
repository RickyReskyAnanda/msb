@extends('admin.index')

@section('content')
<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                <div class="card yellow darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Apakah Anda ingin menghapus data Distrik ?</span>
                        <p>Setelah data terhapus, data tidak dapat dikembalikan !</p>
                    </div>
                    <div class="card-action right">
                        <a href="{{url('administrator/data-master/distrik/delete/'.$id)}}" class="red-text">Hapus Distrik</a>
                        <a href="{{url('administrator/data-master/distrik')}}" class="black-text">Batalkan</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end container-->
@endsection