<?php

namespace App\Http\Controllers\Akses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JalanModel;
use App\Model\DesaModel;
class DataWilayahController extends Controller
{
    public function jalanByDesa($kode){
    	$response = JalanModel::where('kd_desa',$kode)->get();
    	return response()->json($response,200);
    }
    public function desaByDistrik($kode){
    	$response = DesaModel::where('kd_distrik',$kode)->get();
    	return response()->json($response,200);
    }
}
