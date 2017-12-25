@extends('admin.index')

@section('content')
<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                <div class="card yellow darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Apakah Anda ingin menghapus data {{$posisi}} ?</span>
                        <p>Setelah data terhapus, data tidak dapat dikembalikan !</p>
                    </div>
                    <div class="card-action right">
                        <a href="{{url('distrik/berita-acara/delete/'.$posisi.'/'.$id)}}" class="white-text">Hapus</a>
                        <a href="{{url('distrik/berita-acara')}}" class="white-text">Batalkan</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--end container-->
@endsection