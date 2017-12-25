<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SKPDModel;
use App\Model\RKPDModel;
use App\Model\VisiModel;
use App\Model\BidangModel;
use App\Model\ProgramModel;
use App\Model\KegiatanModel;



class LaporanRenjaController extends Controller
{
    public function viewLaporanRenja(Request $request){
    	// $tahun = VisiModel::first();
    	// $tahun = $tahun->per_awal;

    	$skpd = SKPDModel::all();

    // 	$renja = RKPDModel::select('id_bidang')
    // 						->groupBy('id_bidang')
    // 						->where('id_skpd',$request->skpd)
    // 						->get();
    // 	$renjaid =array();

    // 	for($i=0;$i<count($renja);$i++){
    // 		array_push($renjaid,$renja[$i]->id_bidang);
	   //  }
	    
	   //  $renja = array();
	   //  $renja = BidangModel::select('id_bidang','kd_bidang','bidang','sts')->whereIn('id_bidang',$renjaid)->orderBy('kd_bidang','asc')->get();

    // 	for($i=0;$i<count($renja);$i++){
    		
    // 		//proses pengambilan data di rkpd
    // 		$renja[$i]->getprogram = RKPDModel::select('id_prog')
    // 									->groupBy('id_prog')
    // 									->where('id_bidang',$renja[$i]->id_bidang)
    // 									->get();
  		// 	//proses penyusunan id program
    // 		$renjaid =array();

	   //  	for($a=0;$a<count($renja[$i]->getprogram);$a++){
	   //  		array_push($renjaid,$renja[$i]->getprogram[$a]->id_prog);
		  //   }

		  //   //proses pengambilan data program 
		  //   $renja[$i]->getprogram = array();
		  //   $renja[$i]->getprogram = ProgramModel::select('id_prog','kd_prog','program')
		  //   		->whereIn('id_prog',$renjaid)
		  //   		->orderBy('kd_prog','asc')
		  //   		->get();

		  //  	for ($a=0; $a < count($renja[$i]->getprogram); $a++) { 
		  //  		$renja[$i]->getprogram[$a]->getkegiatan = RKPDModel::select('id_kegiatan')
    // 														->groupBy('id_kegiatan')
    // 														->where('id_prog',$renja[$i]->getprogram[$a]->id_prog)
    // 														->get();
	   //  		$renjaid =array();
	   //  		for($b=0;$b<count($renja[$i]->getprogram);$b++){
		  //   		array_push($renjaid,$renja[$i]->getprogram[$a]->getkegiatan[$b]->id_kegiatan);
			 //    }

			 //    $renja[$i]->getprogram[$a]->getkegiatan = array();
			 //    $renja[$i]->getprogram[$a]->getkegiatan = KegiatanModel::select('id_kegiatan','kd_kegiatan','nm_kegiatan')
			 //    														->whereIn('id_kegiatan',$renjaid)
			 //    														->orderBy('kd_kegiatan','asc')
			 //    														->get();
				// for($c=0;$c<count($renja[$i]->getprogram[$a]->getkegiatan);$c++){
				// 	$renja[$i]->getprogram[$a]->getkegiatan[$c]->detail = RKPDModel::where('id_bidang',$renja[$i]->id_bidang)
				// 																	->where('id_prog',$renja[$i]->getprogram[$a]->id_prog)
				// 																	->where('id_kegiatan',$renja[$i]->getprogram[$a]->getkegiatan[$c]->id_kegiatan)
				// 																	->first();
				// }			    														


		  //  	}

    // 	}

        // return view('rkpd.renja.laporan-renja',compact('skpd','renja','request','tahun'));
    	return view('rkpd.renja.laporan-renja',compact('skpd'));
    }


    public function viewEdit($id,$kode){
    	$rkpd = RKPDModel::find($id);
    	return view('rkpd.renja.edit-perkiraan-renja',compact('rkpd','kode'));
    }

    public function postEdit(Request $request){
        $this->validate($request, [
            'id_rkpd'   => 'required|numeric',
            'target'    => 'required|numeric',
            'dana'      => 'required|numeric',
            'kode'      => 'required|numeric',
        ]);

        $kode = $request->kode;
        $data = RKPDModel::find($request->id_rkpd);
        if($kode==0){
            $data->prakiraan_target1 = $request->target;
            $data->prakiraan_pagu1 = $request->dana;
        }
        elseif($kode==1){
            $data->prakiraan_target2 = $request->target;
            $data->prakiraan_pagu2 = $request->dana;
        }
        elseif($kode==2){
            $data->prakiraan_target3 = $request->target;
            $data->prakiraan_pagu3 = $request->dana;
        }
        elseif($kode==3){
            $data->prakiraan_target4 = $request->target;
            $data->prakiraan_pagu4 = $request->dana;
        }
        elseif($kode==4){
            $data->prakiraan_target5 = $request->target;
            $data->prakiraan_pagu5 = $request->dana;
        }

        $data->save();
    	return redirect('administrator/laporan-renja')->with('pesan','Data Telah Diperbaharui');
    }

    public function viewExcel($skpd,$kode){
        $tahun = VisiModel::first();
        $tahun = $tahun->per_awal;

        $renja = RKPDModel::select('id_bidang')
                            ->groupBy('id_bidang')
                            ->where('id_skpd',$skpd)
                            ->get();
        $renjaid =array();

        for($i=0;$i<count($renja);$i++){
            array_push($renjaid,$renja[$i]->id_bidang);
        }
        
        $renja = array();
        $renja = BidangModel::select('id_bidang','kd_bidang','bidang','sts')->whereIn('id_bidang',$renjaid)->orderBy('kd_bidang','asc')->get();

        for($i=0;$i<count($renja);$i++){
            
            //proses pengambilan data di rkpd
            $renja[$i]->getprogram = RKPDModel::select('id_prog')
                                        ->groupBy('id_prog')
                                        ->where('id_bidang',$renja[$i]->id_bidang)
                                        ->get();
            //proses penyusunan id program
            $renjaid =array();

            for($a=0;$a<count($renja[$i]->getprogram);$a++){
                array_push($renjaid,$renja[$i]->getprogram[$a]->id_prog);
            }

            //proses pengambilan data program 
            $renja[$i]->getprogram = array();
            $renja[$i]->getprogram = ProgramModel::select('id_prog','kd_prog','program')
                    ->whereIn('id_prog',$renjaid)
                    ->orderBy('kd_prog','asc')
                    ->get();

            for ($a=0; $a < count($renja[$i]->getprogram); $a++) { 
                $renja[$i]->getprogram[$a]->getkegiatan = RKPDModel::select('id_kegiatan')
                                                            ->groupBy('id_kegiatan')
                                                            ->where('id_prog',$renja[$i]->getprogram[$a]->id_prog)
                                                            ->get();
                $renjaid =array();
                for($b=0;$b<count($renja[$i]->getprogram);$b++){
                    array_push($renjaid,$renja[$i]->getprogram[$a]->getkegiatan[$b]->id_kegiatan);
                }

                $renja[$i]->getprogram[$a]->getkegiatan = array();
                $renja[$i]->getprogram[$a]->getkegiatan = KegiatanModel::select('id_kegiatan','kd_kegiatan','nm_kegiatan')
                                                                        ->whereIn('id_kegiatan',$renjaid)
                                                                        ->orderBy('kd_kegiatan','asc')
                                                                        ->get();
                for($c=0;$c<count($renja[$i]->getprogram[$a]->getkegiatan);$c++){
                    $renja[$i]->getprogram[$a]->getkegiatan[$c]->detail = RKPDModel::where('id_bidang',$renja[$i]->id_bidang)
                                                                                    ->where('id_prog',$renja[$i]->getprogram[$a]->id_prog)
                                                                                    ->where('id_kegiatan',$renja[$i]->getprogram[$a]->getkegiatan[$c]->id_kegiatan)
                                                                                    ->first();
                }                                                                       
            }
        }
        return view('rkpd.renja.excel-renja',compact('renja','kode'));
    }
}
