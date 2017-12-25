<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DistrikModel;
use Auth;

class DistrikController extends Controller
{
    public function viewDistrik(){
        $data = DistrikModel::all();
    	return view('admin.admin.datamaster.distrik.distrik',compact('data'));
    }

    public function viewAddDistrik(){
    	return view('admin.admin.datamaster.distrik.adddistrik');
    }
    public function postAddDistrik(Request $request){
        $this->validate($request, [
            'nm_distrik'  => 'required',
            'sts'         => 'required',
        ]);
        $kd = DistrikModel::max('kd_distrik');
        if($kd==null){
            $kd =  '00001';
        }
        else{
            $pjg   = 5-strlen(++$kd);
            for($i=0;$i<$pjg;$i++){
                $kd = '0'.$kd;
            }
        }
        $distrik = new DistrikModel;
        $distrik->nm_distrik   = $request->nm_distrik;
        $distrik->kd_distrik   = $kd;
        $distrik->sts          = $request->sts;
        $distrik->us_en        = Auth::user()->name;
        $distrik->us_ed        = Auth::user()->name;
        $distrik->save();

        return redirect('administrator/data-master/distrik')->with('pesan', 'Distrik '.$request->nm_distrik.' telah ditambahkan !');
    }


    public function viewEditDistrik($id){
        $detail = DistrikModel::find($id);
    	return view('admin.admin.datamaster.distrik.editdistrik',compact('detail'));
    }

    public function postEditDistrik(Request $request){
        $this->validate($request, [
            'id_distrik'  => 'required|numeric',
            'nm_distrik'  => 'required',
            'sts'         => 'required',
        ]);


        $user = DistrikModel::find($request->id_distrik);
        $user->nm_distrik   = $request->nm_distrik;
        $user->sts          = $request->sts;
        $user->us_ed        = Auth::user()->name;
        $user->save();

        return redirect('administrator/data-master/distrik')->with('pesan', 'Distrik '.$request->nm_distrik.' telah diperbaharui !');
    }

    public function viewDeleteDistrik($id){
        return view('admin.admin.datamaster.distrik.deletedistrik',compact('id'));
    }

    public function deleteDistrik($id){
        $distrik = DistrikModel::find($id);
        $nama = $distrik->nm_distrik;
        $distrik->delete();
        return redirect('administrator/data-master/distrik')->with('pesan', 'Data Distrik '.$nama.' telah dihapus !');
    }
}
