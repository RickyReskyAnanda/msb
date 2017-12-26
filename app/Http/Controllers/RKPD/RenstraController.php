<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataController;
use App\Model\SKPDModel;
use App\Model\RKPDModel;

class RenstraController extends Controller
{
	private $tahun;
    public function __construct(){
        $tahun = new DataController;
        $this->tahun = $tahun->getTahun();
    }

	public function viewRenstra(Request $request){
    	if(isset($request->tahun)){
            $tahun = $request->tahun;
        }else{
            $tahun = date('Y');
        }
        $tahun_ap = $this->tahun;
        $skpd = SKPDModel::all();

        $data = array();
        if(isset($request->skpd))
            if($request->skpd == 'semua')
                $data = RKPDModel::select('id_skpd')->groupBy('id_skpd')->where('sts_rkpd','SKPD')->where('tahun',$tahun)->get();
            else
                $data = RKPDModel::select('id_skpd')->groupBy('id_skpd')->where('id_skpd',$request->skpd)->where('sts_rkpd','SKPD')->where('tahun',$tahun)->get();
        else
            $data = RKPDModel::select('id_skpd')->groupBy('id_skpd')->where('sts_rkpd','SKPD')->where('tahun',$tahun)->get();

        for ($a=0; $a < count($data); $a++) { 
            $data[$a]->prog = RKPDModel::select('id_prog')->groupBy('id_prog')->where('id_skpd',$data[$a]->id_skpd)->where('sts_rkpd','SKPD')->where('tahun',$tahun)->get();

            for ($b=0; $b < count($data[$a]->prog); $b++) { 
            	$data[$a]->prog[$b]->keg = RKPDModel::where('id_skpd',$data[$a]->id_skpd)
            										->where('id_prog',$data[$a]->prog[$b]->id_prog)
            										->where('sts_rkpd','SKPD')
            										->where('tahun',$tahun)
            										->get();
            }
        }

        return view('rkpd.renstra.review-renstra',compact('skpd','data','request','tahun','tahun_ap'));
    }

    public function viewEditRenstra($id){
    	$detail = RKPDModel::find($id);
    	return view('rkpd.renstra.edit-renstra',compact('detail'));
    }

    public function postEditRenstra(Request $request){
    	$this->validate($request,[
    		"id_rkpd" 				=> "required|numeric",
    		"hak_lokasi" 			=> "required",
    		"hak_target_capaian" 	=> "required|numeric",
    		"hak_pagu_indikatif" 	=> "required|numeric",
    		"catatan_penting" 		=> "required",
    		"prakiraan_target" 		=> "required|numeric",
    		"prakiraan_pagu" 		=> "required|numeric"
    	]);

    	$rkpd = RKPDModel::find($request->id_rkpd);
    	$rkpd->hak_lokasi 		= $request->hak_lokasi;
    	$rkpd->hak_target_capaian = $request->hak_target_capaian;
    	$rkpd->hak_pagu_indikatif = $request->hak_pagu_indikatif;
    	$rkpd->catatan_penting = $request->catatan_penting;
    	$rkpd->prakiraan_target = $request->prakiraan_target;
    	$rkpd->prakiraan_pagu = $request->prakiraan_pagu;

    	$rkpd->save();

    	return redirect('rkpd/administrator/review-renstra')->with('pesan','Renstra telah diperbaharui');
    }
}
