<?php

namespace App\Http\Controllers\Distrik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BeritaAcaraModel;
use App\Model\BeritaAcaraSambutanModel;
use App\Model\BeritaAcaraAnggotaModel;
use App\Model\BeritaAcaraDelegasiModel;
use App\Model\DistrikModel;
use App\Model\UsulanDistrikModel;
use Auth;

class BADistrikController extends Controller
{
    public function viewBeritaAcara(){
    	$ba =  BeritaAcaraModel::where('kd_distrik',Auth::user()->kode_wilayah)->first();
    	return view('admin.distrik.beritaacara',compact('ba'));
    }

    public function postBeritaAcara(Request $request){
    	$this->validate($request,[
    			'no_ba' 			=> 'required',
		    	'tgl_ba' 			=> 'required',
		    	'pemateri_lain' 	=> 'required',
		    	'pimpinan_sidang'	=> 'required',
		    	'hari' 				=> 'required',
		    	'tanggal' 			=> 'required',
		    	'waktu' 			=> 'required',
		    	'tempat' 			=> 'required'
    		]);

    	if(isset($request->id_ba)){
	    	$ba = BeritaAcaraModel::find($request->id_ba);
    	}else{
	    	$ba = new BeritaAcaraModel;
    	}
    	$ba->kd_distrik 	= Auth::user()->kode_wilayah;
    	$ba->no_ba 			= $request->no_ba;
    	$ba->tgl_ba 		= $request->tgl_ba;
    	$ba->pemateri_lain 	= $request->pemateri_lain;
    	$ba->pimpinan_sidang= $request->pimpinan_sidang;
    	$ba->hari 			= $request->hari;
    	$ba->tgl 			= $request->tanggal;
    	$ba->pukul 			= $request->waktu;
    	$ba->tempat 		= $request->tempat;
    	$ba->save();

    	return redirect()->back()->with('pesan','Data Telah Disimpan Silahkan Lengkapi Data Dibawah');
    }

    public function postSambutan(Request $request){
    	$this->validate($request,[
    			'id_ba' => 'required|numeric',
    			'sambutan' => 'required',
    		]);


    	$ba = new BeritaAcaraSambutanModel;
    	$ba->sambutan_oleh 	= $request->sambutan;
    	$ba->id_ba = $request->id_ba;
    	$ba->save();
    	
    	return redirect()->back()->with('pesan','Pembawa Sambutan Telah Ditambahkan');
    	
    }

    public function postPeserta(Request $request){
    	$this->validate($request,[
    			'id_ba' 		=> 'required|numeric',
    			'nama_p' 		=> 'required',
    			'asal_p' 		=> 'required',
    			'alamat_p'		=> 'required',
    		]);

    	$ba = new BeritaAcaraAnggotaModel;
    	$ba->id_ba = $request->id_ba;
    	$ba->anggota 	= $request->nama_p;
    	$ba->asal 		= $request->asal_p;
    	$ba->alamat		= $request->alamat_p;
    	$ba->save();

    	return redirect()->back()->with('pesan','Peserta Telah Ditambahkan');
    	
    }

    public function postDelegasi(Request $request){
    	$this->validate($request,[
			'id_ba' 		=> 'required|numeric',
			'nama_d' 		=> 'required',
			'asal_d' 		=> 'required',
			'alamat_d'		=> 'required',
		]);

    	$ba = new BeritaAcaraDelegasiModel;
    	$ba->id_ba = $request->id_ba;
    	$ba->delegasi_nama 		= $request->nama_d;
    	$ba->asal 				= $request->asal_d;
    	$ba->alamat				= $request->alamat_d;
    	$ba->save();

    	return redirect()->back()->with('pesan','Delegasi Telah Ditambahkan');
    }

    public function viewHapus($posisi,$id){
    	return view('admin.distrik.deleteba',compact('posisi','id'));
    }

    public function deletePosisi($posisi,$id){

    	if($posisi == 'peserta'){
	    	BeritaAcaraAnggotaModel::destroy($id);
    	}elseif($posisi == 'sambutan'){
	    	BeritaAcaraSambutanModel::destroy($id);
    	}elseif($posisi == 'delegasi'){
	    	BeritaAcaraDelegasiModel::destroy($id);
    	}

    	return redirect('distrik/berita-acara')->with('pesan','Data '.$posisi.' telah dihapus');
    }

    public function cetakBeritaAcara(){
    	$distrik = DistrikModel::where('kd_distrik',Auth::user()->kode_wilayah)->first();

    	$kec_name = $distrik->nm_distrik;
    	$usulan = UsulanDistrikModel::where('kd_distrik',Auth::user()->kode_wilayah)->get();
    	$detail =  BeritaAcaraModel::where('kd_distrik',Auth::user()->kode_wilayah)->first();
    	return view('admin.distrik.cetakba',compact('detail','kec_name','usulan'));
    }


}