<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DesaModel;
use App\Model\VisiModel;
use App\Model\ProgramModel;

class DataController extends Controller
{
    public function getDesa($id){
    	return DesaModel::where('kd_distrik',$id)->get();
    }

    public function getTahun(){
    	$tahun = VisiModel::first();
    	return $tahun->per_awal;
    }

    public function getProgram($id_bidang){
    	return ProgramModel::where('bidang_urusan',$id_bidang)->get();
    }
}
