<?php

namespace App\Http\Controllers\RKPD;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Model\DistrikModel;
use App\Model\SKPDModel;
use Auth;

class UserController extends Controller
{
    public function viewUser(){
        $user = array();
        if(Auth::user()->level == 'bappeda')$user = User::where('level','bappeda')->where('program','rkpd')->get();
        else $user = User::where('program','rkpd')->get();
    	return view('rkpd.user.tabel-user',compact('user'));
    }

    public function viewAddUser(){
        return view('rkpd.user.tambah-user');
    }
    public function postAddUser(Request $request){
        if ($request->password != $request->konfirmasi) {
            return redirect()
                    ->back()
                    ->with('pesan', 'Password dan Konfirmasi Password tidak sama !');
            
        }

        $this->validate($request, [
            'name'          => 'required',
            'username'      => 'required|min:6|max:32',
            'password'      => 'required|min:6|max:32',
            'konfirmasi'    => 'required|min:6|max:32',
            'level'         => 'required',
            'status'        => 'required',
        ]);
        
        $user = new User;
        $user->name     = ucwords($request->name);
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->level    = $request->level;
        $user->program  = 'rkpd';
        $user->status   = $request->status;

        $user->user_create = Auth::user()->name;
        $user->user_update = Auth::user()->name;
        $user->remember_token = bcrypt($request->password);
        $user->save();


        return redirect('rkpd/administrator/user')->with('pesan', 'User '.$user->name.' telah ditambahkan !');
    }
    public function viewEditUser($id){
        $user = User::find($id);
        return view('rkpd.user.edit-user',compact('user'));
    }
    public function postEditUser(Request $request){
        if(isset($request->password) && isset($request->konfirmasi)){
            if($request->konfirmasi!=$request->password){
                return redirect()->back()->with('pesan','Password dan Konfirmasi Password Tidak Sama');
            }
            $this->validate($request, [
                'id'            => 'required|numeric',
                'name'          => 'required',
                'username'      => 'required|min:6|max:32',
                'password'      => 'required|min:6|max:32',
                'konfirmasi'    => 'required|min:6|max:32',
                'status'        => 'required',
            ]);

            $user  = User::find($request->id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->status = $request->status;

            $user->user_update = Auth::user()->name;
            $user->save();

        }else{
            $this->validate($request, [
                'id'            => 'required|numeric',
                'name'          => 'required',
                'username'      => 'required|min:6|max:32',
                'status'        => 'required',
            ]);


            $user  = User::find($request->id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->status = $request->status;
            $user->user_update = Auth::user()->name;
            $user->save();
        }
        return redirect('rkpd/administrator/user')->with('pesan','Data User '.$user->name.' Telah Diperbaharui');
    }
}
