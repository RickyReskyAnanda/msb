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
                <h5 class="breadcrumbs-title">Kampung</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Data Master</li>
                    <li class="active">Kampung</li>
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
                                    <a href="{{url('administrator/data-master/desa/tambah')}}" class="btn cyan waves-effect waves-light" type="submit" name="action" style="margin-bottom: 10px;">Tambah Kampung
                                    </a>
                                </div>
                            </div>
                            <div class="divider" style="margin:10px 0 20px;"></div>
                            <div class="row">
                                
                                <div class="col s12">
                                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                    <thead>
                                        <th>Kode Distrik</th>
                                        <th>Nama Distrik</th>
                                        <th>Kode Kampung</th>
                                        <th>Nama Kampung</th>
                                        <th>Tanggal Edit</th>
                                        <th>Tanggal Input</th>
                                        <th>Status</th>
                                        <th>User Input</th>
                                        <th>User Edit</th>
                                        <th>Aksi</th>
                                    </thead>
                                 
                                    <tfoot>
                                        <th>Kode Distrik</th>
                                        <th>Nama Distrik</th>
                                        <th>Kode Kampung</th>
                                        <th>Nama Kampung</th>
                                        <th>Tanggal Edit</th>
                                        <th>Tanggal Input</th>
                                        <th>Status</th>
                                        <th>User Input</th>
                                        <th>User Edit</th>
                                        <th>Aksi</th>
                                    </tfoot>
                                 
                                    <tbody>
                                        @foreach($data as $val)
                                            <tr>
                                             <td>{{$val->kd_distrik}}</td>
                                             <td><?php if(isset($val->distrik->nm_distrik)){ echo $val->distrik->nm_distrik;  } ?></td>
                                             <td>{{$val->kd_desa}}</td>
                                             <td>{{$val->nm_desa}}</td>
                                             <td>{{$val->tgl_ed}}</td>
                                             <td>{{$val->tgl_en}}</td>
                                             <td>{{$val->sts}}</td>
                                             <td>{{$val->us_en}}</td>
                                             <td>{{$val->us_ed}}</td>
                                             <td>
                                                <a href="{{url('administrator/data-master/desa/'.$val->id_desa)}}" class="btn waves-effect waves-light blue">Edit</a>
                                                <a href="{{url('administrator/data-master/desa/hapus/'.$val->id_desa)}}" class="btn waves-effect waves-light red darken-4">Hapus</button>
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
<!--end container-->
@endsection