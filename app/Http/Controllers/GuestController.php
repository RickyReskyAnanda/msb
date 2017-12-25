<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Model\KamusUsulanModel;
use App\Model\BidangUrusanModel;
use App\Model\DistrikModel;
use App\Model\DesaModel;
use App\Model\JasmaraModel;
use Image;

class GuestController extends Controller
{
    public function viewBeranda(){
    	return view('admin.guest.beranda');
    }

    public function viewKamusUsulan(){
        $data = KamusUsulanModel::all();
    	return view('admin.guest.kamusUsulan',compact('data'));
    }

    public function viewUsulan(){
    	return view('admin.guest.usulan');
    }

    public function viewAkun(){
    	return view('admin.guest.akun');
    }
    public function postAkun(Request $request){
    	$this->validate($request,[
            'old_pass' 		=> 'required|min:6|max:32',
            'new_pass'  => 'required|min:6|max:32',
            'confirm_pass' 	=> 'required|min:6|max:32'
        ]);

    	$user = User::find(Auth::user()->id);
            if($request->new_pass == $request->confirm_pass){
    	    	$user->password = bcrypt($request->new_pass);
    			$user->save();	    
    			return redirect()->back()->with('pesan', 'Password berhasil diperbaharui !');
    		}else{
    			return redirect()->back()->with('gagal', 'Password dan konfirmasi password tidak sama !')->withInput($request->only('new_pass', 'remember'));
    		}
    }

    public function viewAspirasiMasyarakat(){
        $distrik    = DistrikModel::all();
        $bidang     = BidangUrusanModel::all();
        return view('admin.guest.aspirasimasyarakat',compact('distrik','bidang'));
    }

    public function postAspirasiMasyarakat(Request $request){
        $this->validate($request,[
            'cp_nik'            => 'required',
            'cp_nama'           => 'required',
            'cp_telp'           => 'required',
            'cp_alamat'         => 'required',
            'rincianmasalah'    => 'required',
            'bidang'            => 'required',
            'distrik'           => 'required',
            'rincianusulan'     => 'required',
        ]);        

        $desa = DesaModel::find($request->distrik);

        $jasmara = new JasmaraModel;

        $jasmara->nik               = $request->cp_nik;      
        $jasmara->nm_lengkap        = $request->cp_nama;      
        $jasmara->no_telp_hp        = $request->cp_telp;      
        $jasmara->alamat            = $request->cp_alamat;    
        $jasmara->rincian_masalah   = $request->rincianmasalah;
        $jasmara->id_bidang         = $request->bidang;       
        $jasmara->id_distrik        = $desa->distrik->id_distrik;      
        $jasmara->id_desa           = $request->distrik;      
        $jasmara->rincian_usulan    = $request->rincianusulan;


        if($request->file('foto')){
            $name = date('Ymdhis').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('images/aspirasi/'),$name);

            //resize image
            $pathFind = public_path('images/aspirasi/'.$name);
            $pathSave = public_path('images/aspirasi/thumb/'.$name);
            Image::make($pathFind)->resize(null, 150, function ($constraint){$constraint->aspectRatio();})->save($pathSave);

            $jasmara->gambar_doc    = $name;
        }
        $jasmara->save();

        return redirect()->back()->with('pesan','Usulan Berhasil Di Kirim');
    }
}
