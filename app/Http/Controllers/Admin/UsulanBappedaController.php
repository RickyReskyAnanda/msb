<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UsulanBappedaModel;
use App\Model\SKPDModel;
use App\Model\FotoModel;
use App\Model\RKPDModel;
use File;
use Image;
use Auth;

class UsulanBappedaController extends Controller
{
    public function viewUsulanMasuk(Request $request){
        $skpd = SKPDModel::all();
        $usulan = array();

        if (isset($request->skpd) && isset($request->tipe)) {
            if($request->skpd=='semua' && $request->tipe=='semua'){
                $usulan = UsulanBappedaModel::where('sts_usulan','DIPROSES BAPPEDA')->paginate(10);
            }
            elseif($request->skpd=='semua' && $request->tipe!='semua')
                $usulan = UsulanBappedaModel::where('sts_usulan','DIPROSES BAPPEDA')->where('tipe_keg',$request->tipe)->get();
            elseif($request->tipe=='semua' && $request->skpd!='semua')
                $usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->where('sts_usulan','DIPROSES BAPPEDA')->get();
            else
                $usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->where('sts_usulan','DIPROSES BAPPEDA')->where('tipe_keg',$request->tipe)->get();
        }else{
            $usulan = UsulanBappedaModel::where('sts_usulan','DIPROSES BAPPEDA')->paginate(10);
        }
        return view('admin.admin.usulan.usulan-masuk',compact('usulan','skpd','request'));
    }

    public function viewUsulanVerifikasi(Request $request){
		$skpd = SKPDModel::all();
        $usulan = array();

        if (isset($request->skpd) && isset($request->tipe)) {
            if($request->skpd=='semua' && $request->tipe=='semua')
                $usulan = UsulanBappedaModel::where('sts_usulan','SETUJU')->paginate(10);
            elseif($request->skpd=='semua' && $request->tipe!='semua')
                $usulan = UsulanBappedaModel::where('sts_usulan','SETUJU')->where('tipe_keg',$request->tipe)->get();
            elseif($request->tipe=='semua' && $request->skpd!='semua')
                $usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->where('sts_usulan','SETUJU')->get();
            else
                $usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->where('sts_usulan','SETUJU')->where('tipe_keg',$request->tipe)->get();
        }else{
            $usulan = UsulanBappedaModel::where('sts_usulan','SETUJU')->paginate(10);
        }
    	return view('admin.admin.usulan.usulan-disetujui',compact('usulan','skpd','request'));    	
    }

    public function viewUsulanDitolak(Request $request){
    	$skpd = SKPDModel::all();
        $usulan = array();

        if (isset($request->skpd) && isset($request->tipe)) {
            if($request->skpd=='semua' && $request->tipe=='semua')
                $usulan = UsulanBappedaModel::where('sts_usulan','DITOLAK')->paginate(10);
            elseif($request->skpd=='semua' && $request->tipe!='semua')
                $usulan = UsulanBappedaModel::where('sts_usulan','DITOLAK')->where('tipe_keg',$request->tipe)->get();
            elseif($request->tipe=='semua' && $request->skpd!='semua')
                $usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->where('sts_usulan','DITOLAK')->get();
            else
                $usulan = UsulanBappedaModel::where('id_skpd',$request->skpd)->where('sts_usulan','DITOLAK')->where('tipe_keg',$request->tipe)->get();
        }else{
            $usulan = UsulanBappedaModel::where('sts_usulan','DITOLAK')->paginate(10);
        }
    	return view('admin.admin.usulan.usulan-ditolak',compact('usulan','skpd','request'));    		
    }

    public function viewEditUsulanMasuk($id){
    	$detail = UsulanBappedaModel::find($id);
    	return view('admin.admin.usulan.edit-usulan',compact('detail'));
    }

    public function postEditUsulan(Request $request){
        $this->validate($request,[
                'id_usul_bappeda'   => 'required|numeric',
                'volume'            => 'required|numeric',
                'ket_nomor'         => 'required|numeric',
                'ket_lokasi'        => 'required',
                'link_maps'         => 'required',
                'status_lahan'      => 'required',
                'keterangan'        => 'required',
            ]);
        $bappeda = UsulanBappedaModel::find($request->id_usul_bappeda);

        $bappeda->volume        = $request->volume;
        $bappeda->jalan         = $request->jalan;
        $bappeda->ket_nomor     = $request->ket_nomor;
        $bappeda->ket_lokasi    = $request->ket_lokasi;
        $bappeda->link_maps     = $request->link_maps;
        $bappeda->status_lahan  = $request->status_lahan;
        $bappeda->keterangan    = $request->keterangan;
        $bappeda->save();

        if($request->file('foto')){
            $i=0;
            foreach($request->file('foto') as $file){
                $name = date('Ymdhis').$i++.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/usulan/'),$name);

                //resize image
                $pathFind = public_path('images/usulan/'.$name);
                $pathSave = public_path('images/usulan/thumb/'.$name);
                Image::make($pathFind)->resize(null, 200, function ($constraint){$constraint->aspectRatio();})->save($pathSave);


                $foto = new FotoModel;

                $foto->id_usul_desa = $bappeda->id_usul_desa;
                $foto->level_upload = 'ADMIN';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('administrator/usulan')
                ->with('pesan', 'Usulan telah diperbaharui !');
    } 

    public function viewHapusGambar($id){
    	$foto = FotoModel::find($id);
    	$usulan = UsulanBappedaModel::where('id_usul_desa',$foto->id_usul_desa)->first();
    	return view('admin.admin.usulan.delete-gambar',compact('id','usulan'));
    }

    public function postHapusGambar($id){
    	$foto = FotoModel::find($id);

        $filename = public_path('images/usulan/'.$foto->file_foto);
        $filenamethumb = public_path('images/usulan/thumb/'.$foto->file_foto);
        File::delete([$filename, $filenamethumb]);
        
        $usulan = UsulanBappedaModel::where('id_usul_desa',$foto->id_usul_desa)->first();

        $foto->delete();
        return redirect('administrator/usulan/edit/'.$usulan->id_usul_bappeda)->with('pesan','Gambar telah dihapus !');
    }

    public function viewAlasanPersetujuan($persetujuan,$id){
    	return view('admin.admin.usulan.alasan-persetujuan',compact('persetujuan','id'));
    }

    public function postAlasanPersetujuan(Request $request){
    	$bappeda = UsulanBappedaModel::find($request->id_usul_bappeda);
        if($request->persetujuan == 'terima'){
	    	$bappeda->sts_usulan = 'SETUJU';
	    }elseif ($request->persetujuan == 'tolak') {
	    	$bappeda->sts_usulan = 'DITOLAK'; 
	    }

	    $bappeda->verif_alasan = $request->alasan;
	    $bappeda->save();

	    return redirect('administrator/usulan?skpd='.$bappeda->id_skpd.'&tipe='.$bappeda->tipe_keg)
                ->with('pesan', 'Usulan telah di perbaharui !');
    }
}

