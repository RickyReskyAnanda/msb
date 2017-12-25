<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SKPDModel;
use App\Model\UsulanBappedaModel;

class MusrenbangController extends Controller
{
    public function viewMusrenbang(Request $request){
    	$skpd = SKPDModel::all();
    	$usulan= array();
    	if(isset($request->skpd)){
    		if($request->skpd == "semua")
	    		$usulan = UsulanBappedaModel::where('sts_usulan','SETUJU')->paginate(10);
    		else
	    		$usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->get();
    	}else{
    		$usulan = UsulanBappedaModel::where('sts_usulan','SETUJU')->paginate(10);
    	}

    	return view('rkpd.musrenbang.review-musrenbang',compact('skpd','request','usulan'));
    }
}
