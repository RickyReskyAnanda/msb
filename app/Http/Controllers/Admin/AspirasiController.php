<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DistrikModel;
use App\Model\BidangUrusanModel;
use App\Model\JasmaraModel;
use File;
class AspirasiController extends Controller
{
    public function viewAspirasi(Request $request){
    	$distrik 	= DistrikModel::all();
    	$bidang 	= BidangUrusanModel::all();
    	$usulan  = array();

        if (isset($request->desa) && isset($request->bidang)) {
        	$usulan = JasmaraModel::where('id_desa',$request->desa)->where('id_bidang',$request->bidang)->get();
	    }
    	return view('admin.admin.aspirasi.aspirasi',compact('distrik','bidang','usulan','request'));
    }

    public function viewDeleteAspirasi($id){
    	return view('admin.admin.aspirasi.deleteaspirasi',compact('id'));
    }
    public function deleteAspirasi($id){
    	$aspirasi = JasmaraModel::find($id);

        $filename = public_path('images/aspirasi/'.$aspirasi->gambar_doc);
        $filenamethumb = public_path('images/aspirasi/thumb/'.$aspirasi->gambar_doc);
        File::delete([$filename, $filenamethumb]);

        $aspirasi->delete();

        return redirect('administrator/aspirasi-masyarakat')->with('pesan','Data Aspirasi Masyarakat Telah Dihapus');
    }
}
