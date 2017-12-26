<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class BasicController extends Controller
{
    public function viewBeranda(){
    	return view('rkpd.beranda');
    }
    public function viewRKPD(){
    	return view('rkpd.review-rkpd');
    }

    public function login(){
    	return view('rkpd.login');
    }

    public function profil(){
    	return view('rkpd.profil');
    }
    public function postProfil(Request $request){
    	if($request->baru != $request->konfirmasi)
    		return redirect()->back()->with('peringatan','Password tidak sama');
		
		$user = User::find(Auth::user()->id);
		$user->password = bcrypt($request->baru);
		$user->save();
		return redirect()->back()->with('pesan','password berhasil diperbaharui');

    }
}
