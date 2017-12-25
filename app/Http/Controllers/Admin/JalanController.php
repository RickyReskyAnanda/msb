<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\JalanModel;
use App\Model\DesaModel;
use Auth;

class JalanController extends Controller
{
    public function viewJalan(){
        $data = JalanModel::all();
    	return view('admin.admin.datamaster.jalan.jalan',compact('data'));
    }

    public function viewAddJalan(){
        $desa = DesaModel::where('sts','Y')->orderBy('kd_desa','asc')->get();
        return view('admin.admin.datamaster.jalan.addjalan',compact('desa'));
    }
    public function postAddJalan(Request $request){

        $this->validate($request, [
            'nm_jalan'       => 'required',
            'kd_desa'    => 'required|numeric',
            'status'           => 'required',
        ]);
        $jalan = new JalanModel;
        $jalan->nm_jalan    = $request->nm_jalan;
        $jalan->kd_desa   	= $request->kd_desa;
        $jalan->status      = $request->status;
        $jalan->us_en       = Auth::user()->name;
        $jalan->us_ed       = Auth::user()->name;
        $jalan->save();

        return redirect('administrator/data-master/jalan')->with('pesan', 'Jalan '.$request->nm_jalan.' telah ditambahkan !');
    }


    public function viewEditJalan($id){
        $desa = DesaModel::where('sts','Y')->orderBy('kd_desa','asc')->get();
        $detail = JalanModel::find($id);
        return view('admin.admin.datamaster.jalan.editjalan',compact('detail','desa'));
    }

    public function postEditJalan(Request $request){
        $this->validate($request, [
            'id_jalan'       => 'required|numeric',
            'nm_jalan'       => 'required',
            'kd_desa'    	=> 'required|numeric',
            'status'           => 'required',
        ]);


        $jalan = JalanModel::find($request->id_jalan);
        $jalan->nm_jalan     = $request->nm_jalan;
        $jalan->kd_desa   	 = $request->kd_desa;
        $jalan->status       = $request->status;
        $jalan->us_ed        = Auth::user()->name;
        $jalan->save();

        return redirect('administrator/data-master/jalan')->with('pesan', 'Jalan '.$request->nm_jalan.' telah diperbaharui !');
    }

    public function viewDeleteJalan($id){
        return view('admin.admin.datamaster.jalan.deletejalan',compact('id'));
    }
    public function deleteJalan($id){
        $jalan = JalanModel::find($id);
        $nama = $jalan->nm_jalan;
        $jalan->delete();
        return redirect('administrator/data-master/jalan')->with('pesan', 'Data Jalan '.$nama.' telah dihapus !');
    }
}
