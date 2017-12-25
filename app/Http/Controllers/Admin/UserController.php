<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Model\DistrikModel;
use App\Model\SKPDModel;
use Auth;

class UserController extends Controller
{
    public function viewBeranda(){
    	return view('admin.admin.beranda');
    }

    public function viewManajemenUser($level){
	    $data = User::where('level',$level)->get();
    	return view('admin.admin.manajemenuser.user',compact('data','level'));
    }

    public function viewAddUser($level){
        $distrik = DistrikModel::all();
        $skpd = SKPDModel::all();
        return view('admin.admin.manajemenuser.adduser',compact('distrik','skpd','level'));
    }
    public function postAddUser(Request $request,$level){
        if ($request->password != $request->confirmation) {
            return redirect()
                    ->back()
                    ->with('pesan', 'Password dan Konfirmasi Password tidak sama !');
            
        }

        if($level == 'administrator' || $level == 'bappeda'){
            $this->validate($request, [
                'name'          => 'required',
                'level'         => 'required',
                'username'      => 'required|min:6|max:32',
                'password'      => 'required|min:6|max:32',
                'confirmation'  => 'required|min:6|max:32',
            ]);
        }elseif($level == 'skpd'){
            $this->validate($request, [
                'name'          => 'required',
                'skpd'          => 'required',
                'username'      => 'required|min:6|max:32',
                'password'      => 'required|min:6|max:32',
                'confirmation'  => 'required|min:6|max:32',
            ]);
        }elseif($level == 'distrik'){
            $this->validate($request, [
                'name'          => 'required',
                'distrik'       => 'required',
                'username'      => 'required|min:6|max:32',
                'password'      => 'required|min:6|max:32',
                'confirmation'  => 'required|min:6|max:32',
            ]);
        }elseif($level == 'desa'){
            $this->validate($request, [
                'name'          => 'required',
                'desa'          => 'required',
                'username'      => 'required|min:6|max:32',
                'password'      => 'required|min:6|max:32',
                'confirmation'  => 'required|min:6|max:32',
            ]);
        }elseif($level == 'dprd'){
             $this->validate($request, [
                'name'          => 'required',
                'username'      => 'required|min:6|max:32',
                'password'      => 'required|min:6|max:32',
                'confirmation'  => 'required|min:6|max:32',
            ]);
        }

        $user = new User;
        
        if($level == 'administrator'){
            $user->level          = $request->level;
            $user->kode_wilayah = 0;
        }elseif($level == 'skpd'){
            $user->level          = $level;
            $user->kode_wilayah = $request->skpd;
        }elseif($level == 'distrik'){
            $user->level          = $level;
            $user->kode_wilayah = $request->distrik;
        }elseif($level == 'desa'){
            $user->level          = $level;
            $user->kode_wilayah = $request->desa;
        }elseif($level == 'dprd'){
            $user->level          = $level;
            $user->kode_wilayah = 0;
        }

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->status   = 'terbuka';

        $user->user_create = Auth::user()->name;
        $user->user_update = Auth::user()->name;
        $user->save();

        return redirect('administrator/manajemen-user/'.$level)->with('pesan', 'User '.$request->name.' telah ditambahkan !');
    }
    public function viewEditUser($level,$id){
        $distrik = DistrikModel::all();
        $detail = User::find($id);
        $skpd = SKPDModel::all();
        return view('admin.admin.manajemenuser.edituser',compact('detail','distrik','level','skpd'));
    }
    public function postEditUser(Request $request,$level){
        if($level == 'administrator'){
            $this->validate($request, [
                'name'          => 'required',
                'level'         => 'required',
                'username'      => 'required|min:6|max:32',
                'pass'          => 'nullable|min:6|max:32',
                'confirm'       => 'nullable|min:6|max:32',
            ]);
        }elseif($level == 'skpd'){
            $this->validate($request, [
                'name'          => 'required',
                'skpd'          => 'required',
                'username'      => 'required|min:6|max:32',
                'pass'          => 'nullable|min:6|max:32',
                'confirm'       => 'nullable|min:6|max:32',
            ]);
        }elseif($level == 'distrik'){
            $this->validate($request, [
                'name'          => 'required',
                'distrik'       => 'required',
                'username'      => 'required|min:6|max:32',
                'pass'          => 'nullable|min:6|max:32',
                'confirm'       => 'nullable|min:6|max:32',
            ]);
        }elseif($level == 'desa'){
            $this->validate($request, [
                'name'          => 'required',
                'desa'          => 'required',
                'username'      => 'required|min:6|max:32',
                'pass'          => 'nullable|min:6|max:32',
                'confirm'       => 'nullable|min:6|max:32',
            ]);
        }elseif($level == 'dprd'){
             $this->validate($request, [
                'name'          => 'required',
                'username'      => 'required|min:6|max:32',
                'pass'          => 'required|min:6|max:32',
                'confir'        => 'required|min:6|max:32',
            ]);
        }

        $user = User::find($request->id_user);
        $user->name     = $request->name;
        if($level == 'administrator'){
            $user->level          = $request->level;
            $user->kode_wilayah   = 0;
        }elseif($level == 'skpd'){
            $user->level          = $level;
            $user->kode_wilayah   = $request->skpd;
        }elseif($level == 'distrik'){
            $user->level          = $level;
            $user->kode_wilayah   = $request->distrik;
        }elseif($level == 'desa'){
            $user->level          = $level;
            $user->kode_wilayah   = $request->desa;
        }elseif($level == 'dprd'){
            $user->level          = $level;
            $user->kode_wilayah   = 0;
        }

        $user->status   = $request->status;
        $user->username = $request->username;
        $user->user_update = Auth::user()->name;
        if(isset($request->pass)){
            if($request->pass == $request->confirm){
                $user->password = bcrypt($request->pass);
            }else{
                return redirect()
                    ->back()
                    ->with('pesan', 'Password dan Konfirmasi Password tidak sama !');
            }
        }
    	$user->save();

        return redirect('administrator/manajemen-user/'.$level)->with('pesan', 'Data User '.$user->name.' telah diperbaharui !');

    }
    
    public function viewDeleteUser($level,$id){
        return view('admin.admin.manajemenuser.deleteuser',compact('id','level'));
    }
    public function deleteUser($id,$level){
        $user = User::find($id);
       	$nama = $user->name;
        $user->delete();
        return redirect('administrator/manajemen-user/'.$user->level)->with('pesan', 'Data User '.$nama.' telah dihapus !');
    }

}
