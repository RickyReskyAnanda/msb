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
                <h5 class="breadcrumbs-title">Blank Page</h5>
                <ol class="breadcrumbs">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Blank Page</li>
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
                <div class="card">
                    <div class="card-content">
                        <div id="table-datatables">
                            <h4 class="header">DataTables example</h4>
                            <div class="row">
                                
                                <div class="col s12">
                                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                   <thead>
                                        <th>Kecamatan</th>
                                        <th>Usulan</th>
                                        <th>Lokasi</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                        <th>Volume</th>
                                        <th>Status Catatan</th>
                                        <th>Biaya</th>
                                    </thead>
                                 
                                    <tfoot>
                                        <th>Kecamatan</th>
                                        <th>Usulan</th>
                                        <th>Lokasi</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                        <th>Volume</th>
                                        <th>Status Catatan</th>
                                        <th>Biaya</th>
                                    </tfoot>
                                 
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                        </tr>
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