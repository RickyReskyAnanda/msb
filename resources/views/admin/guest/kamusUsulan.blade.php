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
                <h5 class="breadcrumbs-title">Kamus Usulan</h5>
                <ol class="breadcrumbs">
                    <li><a href="{{url('/')}}">Beranda</a></li>
                    <li class="active">Kamus Usulan</li>
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
                <div class="card  light-blue">
                    <div class="card-content white-text">
                        <span class="card-title">Usulan Non Fisik Berupa Barang</span>
                        <p>Terkait realisasi usulan non fisik berupa barang (selain pelatihan) menunggu peraturan dari Pemerintah Pusat terkait pemberian barang oleh Pemerintah kepada masyarakat.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card  light-blue">
                    <div class="card-content white-text">
                        <span class="card-title">Plafon Anggaran</span>
                        <p>Harga yang dipakai adalah harga tertinggi (plafon anggaran adalah anggaran tertinggi yang bisa dibelanjakan).</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <h4 class="header">Usulan Fisik</h4>
                        <table class="responsive-table display" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Usulan</th>
                                <th>Platform Anggaran</th>
                                <th>Satuan</th>
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
                                            <td>Rp<?=number_format($val->harga_satuan)?></td>
                                            <td>/<?=$val->satuan?></td>
                                        </tr>
                                    <?php }
                                     } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <h4 class="header">Usulan Non Fisik</h4>
                        <table class="responsive-table display" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Usulan</th>
                                <th>Platform Anggaran</th>
                                <th>Satuan</th>
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
                                            <td>Rp<?=number_format($val->harga_satuan)?></td>
                                            <td>/<?=$val->satuan?></td>
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
<!--end container-->
@endsection