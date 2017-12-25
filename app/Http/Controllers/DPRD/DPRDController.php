<?php

namespace App\Http\Controllers\DPRD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SKPDModel;
use App\Model\PokokPikiranDPRDModel;
use Auth;

class DPRDController extends Controller
{
    public function viewBeranda(){
    	return view('admin.dprd.beranda');
    }

    public function viewPokokPikiran(){
    	$pokir = PokokPikiranDPRDModel::all();
    	return view('admin.dprd.pokok-pikiran',compact('pokir'));
    }

    public function viewTambahPokokPikiran(){
    	$skpd = SKPDModel::all();
    	return view('admin.dprd.tambah-pokir',compact('skpd'));
    }

    public function postTambahPokokPikiran(Request $request){
    	$this->validate($request,[
                'program_kegiatan' 	=> 'required',
                'indikator_kinerja' => 'required',
                'volume' 			=> 'required|numeric',
                'lokasi' 			=> 'required',
                'skpd_terkait' 		=> 'required',
                'keterangan' 		=> 'required'
            ]);

    	$pokir = new PokokPikiranDPRDModel;

    	$pokir->program_kegiatan 	= $request->program_kegiatan;
    	$pokir->indikator_kinerja 	= $request->indikator_kinerja;
    	$pokir->volume 				= $request->volume;
    	$pokir->lokasi 				= $request->lokasi;
    	$pokir->skpd_pelaksana		= $request->skpd_terkait;
    	$pokir->ket 				= $request->keterangan;
    	$pokir->us_en 				= Auth::user()->name;
    	$pokir->us_ed 				= Auth::user()->name;
    	$pokir->sts 				= 'Unconfirm';

    	$pokir->save();
    	return redirect('dprd/pokok-pikiran')->with('pesan','Pokok Pikiran Berhasil Disimpan');
    }

    public function viewEditPokokPikiran($id){
    	$pokir = PokokPikiranDPRDModel::find($id);
    	$skpd = SKPDModel::all();
    	return view('admin.dprd.edit-pokir',compact('pokir','skpd'));
    }

    public function postEditPokokPikiran(Request $request){
    	$this->validate($request,[
                'program_kegiatan' 	=> 'required',
                'indikator_kinerja' => 'required',
                'volume' 			=> 'required|numeric',
                'lokasi' 			=> 'required',
                'skpd_terkait' 		=> 'required',
                'keterangan' 		=> 'required'
            ]);

    	$pokir = PokokPikiranDPRDModel::find($request->id_pokir);

    	$pokir->program_kegiatan 	= $request->program_kegiatan;
    	$pokir->indikator_kinerja 	= $request->indikator_kinerja;
    	$pokir->volume 				= $request->volume;
    	$pokir->lokasi 				= $request->lokasi;
    	$pokir->skpd_pelaksana		= $request->skpd_terkait;
    	$pokir->ket 				= $request->keterangan;
    	$pokir->us_ed 				= Auth::user()->name;

    	$pokir->save();
    	return redirect('dprd/pokok-pikiran')->with('pesan','Pokok Pikiran Berhasil Diperbaharui');
    }

    public function viewDeletePokokPikiran($id){
    	return view('admin.dprd.hapus-pokir',compact('id'));
    }

    public function deletePokokPikiran($id){
    	PokokPikiranDPRDModel::destroy($id);
    	return redirect('dprd/pokok-pikiran')->with('pesan','Pokok Pikiran Berhasil Dihapus');
    }
}
