@extends('admin.index')

@section('content')
<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey hide-on-large-only">
        <i class="mdi-action-search active"></i>
        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Skoring</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Data Master</li>
                    <li class="active">Skoring</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->

<!--start container-->
<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12">
                @if (session('pesan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-navigation-check"></i> SUCCESS : {{session('pesan')}}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                
                <div class="card">
                    <div class="card-content">
                        <div id="table-datatables">
                            <div class="row">
                                <div class="col s12">
                                    <a href="{{url('administrator/skoring/tambah')}}" class="btn cyan waves-effect waves-light" type="submit" name="action" style="margin-bottom: 10px;">Tambah Skoring
                                    </a>
                                </div>
                            </div>
                            <div class="divider" style="margin:10px 0 20px;"></div>
                            <div class="row">
                                
                                <div class="col s12">
                                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Kelompok </th>
                                        <th>Faktor 1</th>
                                        <th>Faktor 2</th>
                                        <th>Faktor 3</th>
                                        <th>Aksi</th>
                                    </thead>
                                 
                                    <tfoot>
                                        <th>No</th>
                                        <th>Nama Kelompok </th>
                                        <th>Faktor 1</th>
                                        <th>Faktor 2</th>
                                        <th>Faktor 3</th>
                                        <th>Aksi</th>
                                    </tfoot>
                                 
                                    <tbody>
                                        <?php $i=1;?>
                                        @foreach($data as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->nama_kelompok}}</td>
                                            <td>
                                                <ul class="collection">
                                                  <li class="collection-item">{{$val->faktor1_nilai1}}</li>
                                                  <li class="collection-item">{{$val->faktor1_nilai2}}</li>
                                                  <li class="collection-item">{{$val->faktor1_nilai3}}</li>
                                                  <li class="collection-item">{{$val->faktor1_nilai4}}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="collection">
                                                  <li class="collection-item">{{$val->faktor2_nilai1}}</li>
                                                  <li class="collection-item">{{$val->faktor2_nilai2}}</li>
                                                  <li class="collection-item">{{$val->faktor2_nilai3}}</li>
                                                  <li class="collection-item">{{$val->faktor2_nilai4}}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="collection">
                                                  <li class="collection-item">{{$val->faktor3_nilai1}}</li>
                                                  <li class="collection-item">{{$val->faktor3_nilai2}}</li>
                                                  <li class="collection-item">{{$val->faktor3_nilai3}}</li>
                                                  <li class="collection-item">{{$val->faktor3_nilai4}}</li>
                                                </ul>
                                            </td>
                                             <td>
                                                <a href="{{url('administrator/skoring/'.$val->id_skoring)}}" class="btn waves-effect waves-light blue">Edit</a>
                                                <a href="{{url('administrator/skoring/hapus/'.$val->id_skoring)}}" class="btn waves-effect waves-light red darken-4">Hapus</button>
                                             </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                        
    </div>
</div>
<!--end c2ntainer-->
@endsection