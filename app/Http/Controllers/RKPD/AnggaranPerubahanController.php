<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataController;

use App\Model\SKPDModel;
use App\Model\AnggaranPerubahanModel;
use App\Model\RKPDModel;
use Auth;

class AnggaranPerubahanController extends Controller
{
	private $tahun_p;
    public function __construct(){
        $tahun_p = new DataController;
        $this->tahun_p = $tahun_p->getTahun();
    }
    public function viewAP(Request $request){
    	if(isset($request->laporan)){
    		return redirect('rkpd/administrator/anggaran-perubahan/report/'.$request->skpd.'/'.$request->tahun);
    	}

    	$tahun_p = $this->tahun_p;
    	$tahun = 0;
    	if(isset($request->tahun)){
            $tahun = $request->tahun;
        }else{
            $tahun = date('Y');
        }
        $skpd = SKPDModel::all();
        $data = array();
        if(isset($request->skpd))
            if($request->skpd == 'semua')
	            $data = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
        								->select('id_skpd')
        								->groupBy('id_skpd')
        								->where('trkpd.tahun',$tahun)
        								->orderBy('id_skpd','asc')
        								->get();
            else
	            $data = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
        								->select('id_skpd')
        								->groupBy('id_skpd')
        								->where('trkpd.tahun',$tahun)
        								->where('trkpd.id_skpd',$request->skpd)
        								->orderBy('id_skpd','asc')
        								->get();
        else
        	$data = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
        								->select('id_skpd')
        								->groupBy('id_skpd')
        								->where('trkpd.tahun',$tahun)
        								->orderBy('id_skpd','asc')
        								->get();

        for ($a=0; $a < count($data); $a++) { 
        	$data[$a]->bidang = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
        								->select('id_bidang')
        								->groupBy('id_bidang')
        								->where('trkpd.tahun',$tahun)
        								->where('trkpd.id_skpd',$data[$a]->id_skpd)
        								->orderBy('id_bidang','asc')
        								->get();

        	for ($b=0; $b < count($data[$a]->bidang); $b++) { 
        		$data[$a]->bidang[$b]->program = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
		        								->select('id_prog')
		        								->groupBy('id_prog')
		        								->where('trkpd.tahun',$tahun)
		        								->where('trkpd.id_bidang',$data[$a]->bidang[$b]->id_bidang)
		        								->where('trkpd.id_skpd',$data[$a]->id_skpd)
		        								->orderBy('id_prog','asc')
		        								->get(); 
		        for ($c=0; $c < count($data[$a]->bidang[$b]->program); $c++) { 
		        	$data[$a]->bidang[$b]->program[$c]->kegiatan = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
							        								->where('trkpd.tahun',$tahun)
							        								->where('trkpd.id_prog',$data[$a]->bidang[$b]->program[$c]->id_prog)
							        								->where('trkpd.id_bidang',$data[$a]->bidang[$b]->id_bidang)
							        								->where('trkpd.id_skpd',$data[$a]->id_skpd)
							        								->orderBy('id_prog','asc')
							        								->get(); 
		        }
        	}
        }

        return view('rkpd.anggaran.anggaran',compact('data','skpd','request','tahun','tahun_p'));
    }

    public function viewExcel($skpd,$tahun){

        $data = array();
        if($skpd == 'semua')
            $data = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
                                    ->select('id_skpd')
                                    ->groupBy('id_skpd')
                                    ->where('trkpd.tahun',$tahun)
                                    ->orderBy('id_skpd','asc')
                                    ->get();
        else
            $data = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
                                    ->select('id_skpd')
                                    ->groupBy('id_skpd')
                                    ->where('trkpd.tahun',$tahun)
                                    ->where('trkpd.id_skpd',$skpd)
                                    ->orderBy('id_skpd','asc')
                                    ->get();

        for ($a=0; $a < count($data); $a++) { 
            $data[$a]->bidang = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
                                        ->select('id_bidang')
                                        ->groupBy('id_bidang')
                                        ->where('trkpd.tahun',$tahun)
                                        ->where('trkpd.id_skpd',$data[$a]->id_skpd)
                                        ->orderBy('id_bidang','asc')
                                        ->get();

            for ($b=0; $b < count($data[$a]->bidang); $b++) { 
                $data[$a]->bidang[$b]->program = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
                                                ->select('id_prog')
                                                ->groupBy('id_prog')
                                                ->where('trkpd.tahun',$tahun)
                                                ->where('trkpd.id_bidang',$data[$a]->bidang[$b]->id_bidang)
                                                ->where('trkpd.id_skpd',$data[$a]->id_skpd)
                                                ->orderBy('id_prog','asc')
                                                ->get(); 
                for ($c=0; $c < count($data[$a]->bidang[$b]->program); $c++) { 
                    $data[$a]->bidang[$b]->program[$c]->kegiatan = AnggaranPerubahanModel::join('trkpd', 'trkpd_ap.id_rkpd', '=', 'trkpd.id_rkpd')
                                                                    ->where('trkpd.tahun',$tahun)
                                                                    ->where('trkpd.id_prog',$data[$a]->bidang[$b]->program[$c]->id_prog)
                                                                    ->where('trkpd.id_bidang',$data[$a]->bidang[$b]->id_bidang)
                                                                    ->where('trkpd.id_skpd',$data[$a]->id_skpd)
                                                                    ->orderBy('id_prog','asc')
                                                                    ->get(); 
                }
            }
        }

        return view('rkpd.anggaran.excel-anggaran',compact('data','tahun'));
    }
    public function viewInputAP($id_rkpd){
    	$detail = RKPDModel::find($id_rkpd);
    	return view('rkpd.anggaran.input',compact('detail'));
    }

    public function postInputAP(Request $request){
    	$this->validate($request,[
	    	"id_rkpd" 		=> "required",
	    	"target" 		=> "required",
	    	"satuan" 		=> "required",
	    	"pagu" 			=> "required",
	    	"keterangan" 	=> "required"
	    ]);
    	$rkpd = RKPDModel::find($request->id_rkpd);

	   	$anggaran = new AnggaranPerubahanModel;
	   	$anggaran->id_rkpd 	= $request->id_rkpd;
	   	$anggaran->target 	= $request->target;
	   	$anggaran->satuan_ap 	= $request->satuan;
	   	$anggaran->anggaran = $request->pagu;
	   	$anggaran->tambah_kurang = $anggaran->anggaran - $rkpd->hak_pagu_indikatif;
	   	$anggaran->ket 		= $request->keterangan;
	   	$anggaran->sah_ap 		= 'TIDAK';
	   	$anggaran->us_en 	= Auth::user()->name;
	   	$anggaran->us_ed 	= Auth::user()->name;
	   	$anggaran->save();

	   	return redirect('rkpd/administrator/anggaran-perubahan')->with('pesan','Anggaran Perubahan telah disimpan');
    }

    public function pengesahan($id){
        $anggaran = AnggaranPerubahanModel::find($id);

        $anggaran->sah_ap = 'YA';

        $anggaran->save();

        return 'berhasil';
    }

    public function viewEditAP($id){
    	$detail = AnggaranPerubahanModel::find($id);
    	return view('rkpd.anggaran.edit',compact('detail'));
    }

    public function postEditAP(Request $request){
    	$this->validate($request,[
	    	"id_rkpd" 		=> "required",
	    	"target" 		=> "required",
	    	"satuan" 		=> "required",
	    	"pagu" 			=> "required",
	    	"keterangan" 	=> "required"
	    ]);
    	$rkpd = RKPDModel::find($request->id_rkpd);

	   	$anggaran = AnggaranPerubahanModel::find($request->id_rkpd);
	   	$anggaran->target 	= $request->target;
	   	$anggaran->satuan_ap 	= $request->satuan;
	   	$anggaran->anggaran = $request->pagu;
	   	$anggaran->tambah_kurang = $anggaran->anggaran - $rkpd->hak_pagu_indikatif;
	   	$anggaran->ket 		= $request->keterangan;
	   	$anggaran->us_ed 	= Auth::user()->name;
	   	$anggaran->save();

	   	return redirect('rkpd/administrator/anggaran-perubahan')->with('pesan','Anggaran Perubahan telah diperbaharui');
    }
}
