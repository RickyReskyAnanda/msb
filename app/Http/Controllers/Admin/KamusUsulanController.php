<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\KamusUsulanModel;
use App\Model\SKPDModel;
use App\Model\SatuanModel;
use App\Model\BidangUrusanModel;
use App\Model\SkoringModel;
use Auth;
use App\Http\Controllers\DataController;
class KamusUsulanController extends Controller
{

    private $tahun;
    public function __construct()
    {
        $this->tahun = new DataController();
    }

    public function viewKamusUsulan(){
        $data = KamusUsulanModel::all();
    	return view('admin.admin.kamususulan.kamususulan',compact('data'));
    }

    public function viewAddKamusUsulan(){
    	$skpd = SKPDModel::all();
        $satuan = SatuanModel::all();
        $bidang = BidangUrusanModel::all();
        $skoring = SkoringModel::all();
        $tahun = $this->tahun->getTahun();
        return view('admin.admin.kamususulan.addkamususulan',compact('skpd','satuan','bidang','skoring','tahun'));
    }
    public function postAddKamusUsulan(Request $request){
        $this->validate($request, [
            "tahun"             =>'required|numeric',
            "skpd"              =>'required',
            "tipe"              =>'required|numeric',
            "nm_pekerjaan"      =>'required',
            "satuan"            =>'required',
            "harga"             =>'required|numeric',
            "target"            =>'required|numeric',
            "bidang_urusan"     =>'required',
            "nama_kelompok"     =>'required|numeric',
        ]);

        $tipe ='';
        if($request->tipe == '1') $tipe = 'FISIK';
        elseif($request->tipe == '2') $tipe = 'NON FISIK';

        $kamus = new KamusUsulanModel;

        $kamus->tahun            = $request->tahun;
        $kamus->skpd_pelaksana      = $request->skpd;
        $kamus->tipe_keg            = $request->tipe;
        $kamus->nama_pekerjaan      = ucwords($request->nm_pekerjaan);
        $kamus->satuan              = $request->satuan;
        $kamus->harga_satuan        = $request->harga;
        $kamus->target              = $request->target;
        $kamus->jumlah              = $request->harga*$request->target;
        $kamus->bidang_urusan       = $request->bidang_urusan;
        $kamus->id_skoring          = $request->nama_kelompok;
        $kamus->status              = 'AKTIF';
        $kamus->sts_rpjmd           = 'FALSE';
        $kamus->us_en               = ucwords(Auth::user()->name);
        $kamus->us_ed               = ucwords(Auth::user()->name);
        $kamus->save();

        return redirect('administrator/kamus-usulan')->with('pesan', 'Kamus Usulan '.$request->nm_pekerjaan.' telah ditambahkan !');
    }


    public function viewEditKamusUsulan($id){
        $detail = KamusUsulanModel::find($id);
        $skpd   = SKPDModel::all();
        $satuan = SatuanModel::all();
        $bidang = BidangUrusanModel::all();
        $skoring = SkoringModel::all();
        $tahun = $this->tahun->getTahun();
        return view('admin.admin.kamususulan.editkamususulan',compact('detail','skpd','satuan','bidang','skoring','tahun'));
    }

    public function postEditKamusUsulan(Request $request){

        if($request->status_rpjmd == 'TRUE'){
            $this->validate($request, [
                "id_pekerjaan"      =>'required|numeric',
                "status_rpjmd"      =>'required',
                "nama_kelompok"     =>'required|numeric',
            ]);    
        }elseif($request->status_rpjmd == 'FALSE'){
            $this->validate($request, [
                "id_pekerjaan"      =>'required|numeric',
                "status_rpjmd"      =>'required',
                "tahun"             =>'required|numeric',
                "skpd"              =>'required',
                "tipe"              =>'required|numeric',
                "nm_pekerjaan"      =>'required',
                "satuan"            =>'required',
                "harga"             =>'required|numeric',
                "target"            =>'required|numeric',
                "bidang_urusan"     =>'required',
                "nama_kelompok"     =>'required|numeric',
                "status"            =>'required',
            ]);
        }

        $kamus = KamusUsulanModel::find($request->id_pekerjaan);

        

        if($request->sts_rpjmd == 'TRUE'){
            $tipe ='';
            if($request->tipe == '1') $tipe = 'FISIK';
            elseif($request->tipe == '2') $tipe = 'NON FISIK';
            $kamus->tahun               = $request->tahun;
            $kamus->skpd_pelaksana      = $request->skpd;
            $kamus->tipe_keg            = $request->tipe;
            $kamus->nama_pekerjaan      = ucwords($request->nm_pekerjaan);
            $kamus->satuan              = $request->satuan;
            $kamus->harga_satuan        = $request->harga;
            $kamus->target              = $request->target;
            $kamus->jumlah              = $request->harga*$request->target;
            $kamus->bidang_urusan       = $request->bidang_urusan;
            $kamus->status              = $request->status;
        }

        $kamus->us_ed               = ucwords(Auth::user()->name);
        $kamus->id_skoring          = $request->nama_kelompok;
        $kamus->save();

        return redirect('administrator/kamus-usulan')->with('pesan', 'Kamus Usulan '.$kamus->nama_pekerjaan.' telah diperbaharui !');

    }
    public function viewDeleteKamusUsulan($id){
        return view('admin.admin.kamususulan.deleteKamusUsulan',compact('id'));
    }
    public function deleteKamusUsulan($id){
        $kamus = KamusUsulanModel::find($id);
        if($kamus->sts_rpjmd == 'FALSE'){
            $nama = $kamus->nama_pekerjaan;
            $kamus->delete();
            return redirect('administrator/kamus-usulan')->with('pesan', 'Data Kamus Usulan '.$nama.' telah dihapus !');
        }elseif($kamus->sts_rpjmd == 'TRUE'){
            return redirect('administrator/kamus-usulan')->with('peringatan', 'Data Kamus Usulan '.$nama.' tidak diizinkan untuk dihapus !');
        }
    }
}
