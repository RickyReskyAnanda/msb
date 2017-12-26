@extends('rkpd.index')

@section('content')
<style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 4px;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Master User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('administrator')}}">Beranda</a>
            </li>
            <li class="active">
                <strong>Master User</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            @if (session('pesan'))
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                SUKSES : {{session('pesan')}}
            </div>
            @endif
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>MASTER USER</h5>
                </div>
                <div class="ibox-content">
                    <a href="{{url('rkpd/administrator/user/tambah')}}" class="btn btn-primary ">Tambah User</a>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($user as $users)
                                <tr>
                                    <td class="center">{{$i++}}</td>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->username}}</td>
                                    <td>{{$users->level}}</td>
                                    <td>{{$users->status}}</td>
                                    <td class="center">
                                        <a href="{{url('rkpd/administrator/user/edit/'.$users->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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
    
    <div class="footer">
        <div>
            <strong>Copyright</strong> BAPPEDA KABUPATEN YALIMO
        </div>
    </div>
</div>
@endsection