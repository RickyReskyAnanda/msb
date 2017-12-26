<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataController;

use App\Model\VisiModel;
use App\Model\ProgramModel;
use App\Model\SKPDModel;
use App\Model\RKPDModel;
use App\Model\BidangModel;
use App\Model\SatuanModel;
use App\Model\SumberDanaModel;
use App\Model\UsulanBappedaModel;
use Auth;

class LaporanRKPDController extends Controller
{
    private $tahun;
    public function __construct(){
        $tahun = new DataController;
        $this->tahun = $tahun->getTahun();
    }
    public function viewLaporanRKPD(Request $request){

        $skpd = SKPDModel::all();
        $program = array();
        if (isset($request->skpd)) {
            $program = RKPDModel::select('id_prog')->groupBy('id_prog')->where('id_skpd',$request->skpd)->get();
        }
        return view('rkpd.rkpd.laporan-rkpd',compact('program','skpd','request'));
    }

    public function reviewRKPD(Request $request){
        if(isset($request->tahun)){
            $tahun = $request->tahun;
        }else{
            $tahun = date('Y');
        }
        $skpd = SKPDModel::all();
        $tahun_ap = $this->tahun;
        $data = array();
        if(isset($request->skpd))
            if($request->skpd == 'semua')
                $data = RKPDModel::select('id_skpd')->groupBy('id_skpd')->where('tahun',$tahun)->get();
            else
                $data = RKPDModel::select('id_skpd')->groupBy('id_skpd')->where('id_skpd',$request->skpd)->where('tahun',$tahun)->get();
        else
            $data = RKPDModel::select('id_skpd')->groupBy('id_skpd')->where('tahun',$tahun)->get();

        for ($a=0; $a < count($data); $a++) { 
            $data[$a]->program = RKPDModel::select('id_prog')->groupBy('id_prog')->where('id_skpd',$data[$a]->id_skpd)->where('tahun',$tahun)->get();

            for ($b=0; $b < count($data[$a]->program); $b++) { 
                $data[$a]->program[$b]->kegiatan = RKPDModel::where('id_prog',$data[$a]->program[$b]->id_prog)
                                                            ->where('id_skpd',$data[$a]->id_skpd)
                                                            ->where('tahun',$tahun)
                                                            ->get();
            }
        }

        return view('rkpd.rkpd.review-rkpd',compact('skpd','data','request','tahun','tahun_ap'));
        
    }

    public function viewInputRKPD($jenis,$id = NULL){
        $tahun = $this->tahun;
        $bidang = BidangModel::all();
        $skpd = SKPDModel::all();
        $satuan = SatuanModel::all();
        $sumberDana = SumberDanaModel::all();

        $detail = array();

        if($jenis == 'manual_msb')
            $detail = UsulanBappedaModel::find($id);

        return view('rkpd.rkpd.input-rkpd',compact('tahun','bidang','satuan','sumberDana','jenis','skpd','detail'));
    }

    public function postInputRKPD(Request $request){
        $this->validate($request,[
            "id_usul_bappeda"       => "nullable",
            "sts_rkpd"              => "required",
            "tahun_rkpd"            => "required|numeric",
            "bidang"                => "required|numeric",
            "skpd"                  => "required|numeric",
            "program"               => "required|numeric",
            "nama_kegiatan"         => "required",
            "lokasi"                => "required",
            "satuan"                => "required",
            "indikator_kinerja"     => "required",
            "target_capaian"        => "required|numeric",
            "pagu_indikatif"        => "required|numeric",
            "sumber_dana"           => "required",
            "hak_lokasi"            => "required",
            "hak_target_capaian"    => "required|numeric",
            "hak_pagu_indikatif"    => "required|numeric",
            "catatan_penting"       => "required",
            "prakiraan_target"      => "required|numeric",
            "prakiraan_pagu"        => "required|numeric"
        ]);

        $rkpd = new RKPDModel;

        $bappeda = UsulanBappedaModel::find($request->id_usul_bappeda);


        if($request->sts_rkpd == 'manual_msb'){
            $rkpd->id_kegiatan          = $bappeda->id_keg;
            $rkpd->id_usul_bappeda      = $request->id_usul_bappeda;
            $rkpd->id_skpd              = $bappeda->id_skpd;
        }elseif($request->sts_rkpd == 'manual_rkpd'){
            $rkpd->id_skpd              = $request->skpd;
        }
        $rkpd->nm_kegiatan          = $request->nama_kegiatan;
        $rkpd->tahun                = $request->tahun_rkpd;
        $rkpd->id_bidang            = $request->bidang;
        $rkpd->id_prog              = $request->program;
        $rkpd->lokasi               = $request->lokasi;
        $rkpd->satuan               = $request->satuan;
        $rkpd->indikator_kinerja    = $request->indikator_kinerja;
        $rkpd->indikator_kinerja    = $request->indikator_kinerja;
        $rkpd->target               = $request->target_capaian;
        $rkpd->pagu_indikatif       = $request->pagu_indikatif;
        $rkpd->sumber_dana          = $request->sumber_dana;
        $rkpd->hak_lokasi           = $request->hak_lokasi;
        $rkpd->hak_lokasi           = $request->hak_lokasi;
        $rkpd->hak_target_capaian   = $request->hak_target_capaian;
        $rkpd->hak_pagu_indikatif   = $request->hak_pagu_indikatif;
        $rkpd->catatan_penting      = $request->catatan_penting;
        $rkpd->prakiraan_pagu       = $request->prakiraan_pagu;
        $rkpd->prakiraan_target     = $request->prakiraan_target;
        $rkpd->us_en                = Auth::user()->name;
        $rkpd->us_ed                = Auth::user()->name;
        $rkpd->sts_rkpd             = $request->sts_rkpd;
        $rkpd->sah                  = 'TIDAK';
        $rkpd->save();

        return redirect('rkpd/administrator/review-rkpd')->with('pesan','Data RKPD berhasil ditambahkan');

    }

    public function viewExcel($skpd,$kode){
        $i=$kode;

        $tahun = VisiModel::first();
        $tahun = $tahun->per_awal;
        $program = RKPDModel::select('id_prog')->groupBy('id_prog')->where('id_skpd',$skpd)->get();

        return view('rkpd.rkpd.excel-rkpd',compact('skpd','i','tahun','program'));
    }

    public function pengesahan($id){
        $rkpd = RKPDModel::find($id);

        $rkpd->sah = 'YA';

        $rkpd->save();

        return 'berhasil';
    }
}
