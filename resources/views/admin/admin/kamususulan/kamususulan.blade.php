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
                <h5 class="breadcrumbs-title">Kelola Kamus Usulan</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('administrator')}}">Beranda</a></li>
                    <li>Kamus Usulan</li>
                    <li class="active">Kelola Kamus Usulan</li>
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
                
                @if (session('peringatan'))
                <div id="card-alert" class="card green">
                    <div class="card-content white-text">
                        <p><i class="mdi-navigation-check"></i> SUCCESS : {{session('peringatan')}}</p>
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
                                    <a href="{{url('administrator/kamus-usulan/tambah')}}" class="btn cyan waves-effect waves-light" type="submit" name="action" style="margin-bottom: 10px;">Tambah Kamus Usulan
                                    </a>
                                </div>
                            </div>
                            <div class="divider" style="margin:10px 0 20px;"></div>
                            <div class="row">
                                <div class="col s12">
                                    <ul class="tabs tab-demo">
                                        <li class="tab col s3"><a class="active" href="#fisik">USULAN FISIK</a></li>
                                        <li class="tab col s3"><a href="#nonfisik">USULAN NON FISIK</a></li>
                                    </ul>
                                </div>
                                <div class="col s12">
                                    <div id="fisik" class="col s12" style="padding-top: 20px;">
                                        <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                            <thead>
                                                <th>No</th>
                                                <th>Usulan Fisik</th>
                                                <th>Harga Satuan</th>
                                                <th>Satuan</th>
                                                <th>Pagu Indikatif</th>
                                                <th>Target Capaian</th>
                                                <th>SKPD Pelaksana</th>
                                                <th>Status RPJMD</th>
                                                <th>Status Aktif</th>
                                                <th>Aksi</th>
                                            </thead>
                                         
                                            <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($data as $val) {
                                                if($val->tipe_keg=='FISIK'){
                                                ?>
                                                <tr>
                                                    <td><?=$i++?></td>
                                                    <td><?=$val->nama_pekerjaan?></td>
                                                    <td>Rp.<?=number_format($val->harga_satuan)?></td>
                                                    <td><?=$val->satuan?></td>
                                                    <td>Rp.<?=number_format($val->jumlah)?></td>
                                                    <td><?=$val->target?></td>
                                                    <td><?=$val->skpd_pelaksana?></td>
                                                    <td><?=$val->sts_rpjmd?></td>
                                                    <td><?=$val->status?></td>
                                                    <td>
                                                        <a href="{{url('administrator/kamus-usulan/'.$val->id_pekerjaan)}}" class="btn waves-effect waves-light blue">Edit</a>
                                                        @if($val->sts_rpjmd == 'FALSE')
                                                        <a href="{{url('administrator/kamus-usulan/hapus/'.$val->id_pekerjaan)}}" class="btn waves-effect waves-light red darken-4">Hapus</button>
                                                        @endif
                                                     </td>
                                                </tr>
                                            <?php }
                                             } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="nonfisik" class="col s12" style="padding-top: 20px;">
                                        <table id="data-table-simple2" class="responsive-table display" cellspacing="0">
                                            <thead>
                                                <th>No</th>
                                                <th>Usulan Fisik</th>
                                                <th>Harga Satuan</th>
                                                <th>Satuan</th>
                                                <th>Pagu Indikatif</th>
                                                <th>Target Capaian</th>
                                                <th>SKPD Pelaksana</th>
                                                <th>Status RPJMD</th>
                                                <th>Status Aktif</th>
                                                <th>Aksi</th>
                                            </thead>
                                         
                                            <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($data as $val) {
                                                if($val->tipe_keg=='NON FISIK'){
                                                ?>
                                                <tr>
                                                    <td><?=$i++?></td>
                                                    <td><?=$val->nama_pekerjaan?></td>
                                                    <td>Rp.<?=number_format($val->harga_satuan)?></td>
                                                    <td><?=$val->satuan?></td>
                                                    <td>Rp.<?=number_format($val->jumlah)?></td>
                                                    <td><?=$val->target?></td>
                                                    <td><?=$val->skpd_pelaksana?></td>
                                                    <td><?=$val->sts_rpjmd?></td>
                                                    <td><?=$val->status?></td>
                                                    <td>
                                                        <a href="{{url('administrator/kamus-usulan/'.$val->id_pekerjaan)}}" class="btn waves-effect waves-light blue">Edit</a>
                                                        @if($val->sts_rpjmd == 'FALSE')
                                                        <a href="{{url('administrator/kamus-usulan/hapus/'.$val->id_pekerjaan)}}" class="btn waves-effect waves-light red darken-4">Hapus</button>
                                                        @endif
                                                     </td>
                                                </tr>
                                            <?php }
                                             } ?>
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
</div>
<!--end container-->
@endsection