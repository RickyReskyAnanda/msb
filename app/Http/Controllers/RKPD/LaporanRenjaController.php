<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataController;
use App\Model\SKPDModel;
use App\Model\RKPDModel;
use App\Model\VisiModel;
use App\Model\BidangModel;
use App\Model\ProgramModel;
use App\Model\KegiatanModel;



class LaporanRenjaController extends Controller
{
    private $tahun;
    public function __construct(){
        $tahun = new DataController;
        $this->tahun = $tahun->getTahun();
    }

    public function viewLaporanRenja(Request $request){
    	
        if(isset($request->cari) && $request->cari=='cetak'){
            return redirect('rkpd/administrator/laporan-renja/report/'.$request->skpd.'/'.$request->tahun);
        }

        $tahun_ap = $this->tahun;
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
                $data = RKPDModel::select('id_skpd')
                                        ->groupBy('id_skpd')
                                        ->where('trkpd.tahun',$tahun)
                                        ->orderBy('id_skpd','asc')
                                        ->where('sah','YA')
                                        ->get();
            else
                $data = RKPDModel::select('id_skpd')
                                        ->groupBy('id_skpd')
                                        ->where('trkpd.tahun',$tahun)
                                        ->where('trkpd.id_skpd',$request->skpd)
                                        ->orderBy('id_skpd','asc')
                                        ->where('sah','YA')
                                        ->get();
        else
            $data = RKPDModel::select('id_skpd')
                                        ->groupBy('id_skpd')
                                        ->where('trkpd.tahun',$tahun)
                                        ->orderBy('id_skpd','asc')
                                        ->where('sah','YA')
                                        ->get();

        for ($a=0; $a < count($data); $a++) { 
            $data[$a]->bidang = RKPDModel::select('id_bidang')
                                        ->groupBy('id_bidang')
                                        ->where('trkpd.tahun',$tahun)
                                        ->where('trkpd.id_skpd',$data[$a]->id_skpd)
                                        ->orderBy('id_bidang','asc')
                                        ->where('sah','YA')
                                        ->get();

            for ($b=0; $b < count($data[$a]->bidang); $b++) { 
                $data[$a]->bidang[$b]->program = RKPDModel::select('id_prog')
                                                ->groupBy('id_prog')
                                                ->where('trkpd.tahun',$tahun)
                                                ->where('trkpd.id_bidang',$data[$a]->bidang[$b]->id_bidang)
                                                ->where('trkpd.id_skpd',$data[$a]->id_skpd)
                                                ->orderBy('id_prog','asc')
                                                ->where('sah','YA')
                                                ->get(); 
                for ($c=0; $c < count($data[$a]->bidang[$b]->program); $c++) { 
                    $data[$a]->bidang[$b]->program[$c]->kegiatan = RKPDModel::where('trkpd.tahun',$tahun)
                                                                    ->where('trkpd.id_prog',$data[$a]->bidang[$b]->program[$c]->id_prog)
                                                                    ->where('trkpd.id_bidang',$data[$a]->bidang[$b]->id_bidang)
                                                                    ->where('trkpd.id_skpd',$data[$a]->id_skpd)
                                                                    ->orderBy('id_prog','asc')
                                                                    ->where('sah','YA')
                                                                    ->get(); 
                }
            }
        }

        return view('rkpd.renja.laporan-renja',compact('skpd','data','request','tahun','tahun_ap'));
    	// return view('rkpd.renja.laporan-renja',compact('skpd'));
    }

    public function viewExcel($skpd,$tahun){
        $data = array();
        if($skpd == 'semua')
            $data = RKPDModel::select('id_skpd')
                                    ->groupBy('id_skpd')
                                    ->where('tahun',$tahun)
                                    ->orderBy('id_skpd','asc')
                                    ->where('sah','YA')
                                    ->get();
        else
            $data = RKPDModel::select('id_skpd')
                                    ->groupBy('id_skpd')
                                    ->where('tahun',$tahun)
                                    ->where('id_skpd',$skpd)
                                    ->orderBy('id_skpd','asc')
                                    ->where('sah','YA')
                                    ->get();
        

        for ($a=0; $a < count($data); $a++) { 
            $data[$a]->bidang = RKPDModel::select('id_bidang')
                                        ->groupBy('id_bidang')
                                        ->where('tahun',$tahun)
                                        ->where('id_skpd',$data[$a]->id_skpd)
                                        ->orderBy('id_bidang','asc')
                                        ->where('sah','YA')
                                        ->get();

            for ($b=0; $b < count($data[$a]->bidang); $b++) { 
                $data[$a]->bidang[$b]->program = RKPDModel::select('id_prog')
                                                ->groupBy('id_prog')
                                                ->where('tahun',$tahun)
                                                ->where('id_bidang',$data[$a]->bidang[$b]->id_bidang)
                                                ->where('id_skpd',$data[$a]->id_skpd)
                                                ->orderBy('id_prog','asc')
                                                ->where('sah','YA')
                                                ->get(); 
                for ($c=0; $c < count($data[$a]->bidang[$b]->program); $c++) { 
                    $data[$a]->bidang[$b]->program[$c]->kegiatan = RKPDModel::where('tahun',$tahun)
                                                                    ->where('id_prog',$data[$a]->bidang[$b]->program[$c]->id_prog)
                                                                    ->where('id_bidang',$data[$a]->bidang[$b]->id_bidang)
                                                                    ->where('id_skpd',$data[$a]->id_skpd)
                                                                    ->orderBy('id_prog','asc')
                                                                    ->where('sah','YA')
                                                                    ->get(); 
                }
            }
        }

        return view('rkpd.renja.excel-renja',compact('data','tahun'));
    }
}
