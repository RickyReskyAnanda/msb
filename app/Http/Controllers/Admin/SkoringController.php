<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SkoringModel;
use Auth;

class SkoringController extends Controller
{
    public function viewSkoring(){
        $data = SkoringModel::all();
    	return view('admin.admin.skoring.skoring',compact('data'));
    }

    public function viewAddSkoring(){
    	return view('admin.admin.skoring.addskoring');
    }
    public function postAddSkoring(Request $request){
        $this->validate($request, [
            'nama_kelompok'  	=> 'required',
            'faktor1_nilai1'  	=> 'nullable',
            'faktor1_nilai2'  	=> 'nullable',
            'faktor1_nilai3'  	=> 'nullable',
            'faktor1_nilai4'  	=> 'nullable',
            'faktor2_nilai1'  	=> 'nullable',
            'faktor2_nilai2'  	=> 'nullable',
            'faktor2_nilai3'  	=> 'nullable',
            'faktor2_nilai4'  	=> 'nullable',
            'faktor3_nilai1'  	=> 'nullable',
            'faktor3_nilai2'  	=> 'nullable',
            'faktor3_nilai3'  	=> 'nullable',
            'faktor3_nilai4'  	=> 'nullable',
        ]);


        $skoring = new SkoringModel;
        $skoring->nama_kelompok	    = $request->nama_kelompok;
        $skoring->faktor1_nilai1	= $request->faktor1_nilai1;
        $skoring->faktor1_nilai2	= $request->faktor1_nilai2;
        $skoring->faktor1_nilai3	= $request->faktor1_nilai3;
        $skoring->faktor1_nilai4	= $request->faktor1_nilai4;
        $skoring->faktor2_nilai1	= $request->faktor2_nilai1;
        $skoring->faktor2_nilai2	= $request->faktor2_nilai2;
        $skoring->faktor2_nilai3	= $request->faktor2_nilai3;
        $skoring->faktor2_nilai4	= $request->faktor2_nilai4;
        $skoring->faktor3_nilai1	= $request->faktor3_nilai1;
        $skoring->faktor3_nilai2	= $request->faktor3_nilai2;
        $skoring->faktor3_nilai3	= $request->faktor3_nilai3;
        $skoring->faktor3_nilai4	= $request->faktor3_nilai4;
        $skoring->us_en        	    = Auth::user()->name;
        $skoring->us_ed        	    = Auth::user()->name;
        $skoring->save();

        return redirect('administrator/skoring')->with('pesan', 'Skoring '.$request->skoring.' telah ditambahkan !');
    }


    public function viewEditSkoring($id){
        $detail = SkoringModel::find($id);
    	return view('admin.admin.skoring.editskoring',compact('detail'));
    }

    public function postEditSkoring(Request $request){
        $this->validate($request, [
            'id_skoring'        => 'required|numeric',
            'nama_kelompok'     => 'required',
            'faktor1_nilai1'    => 'nullable',
            'faktor1_nilai2'    => 'nullable',
            'faktor1_nilai3'    => 'nullable',
            'faktor1_nilai4'    => 'nullable',
            'faktor2_nilai1'    => 'nullable',
            'faktor2_nilai2'    => 'nullable',
            'faktor2_nilai3'    => 'nullable',
            'faktor2_nilai4'    => 'nullable',
            'faktor3_nilai1'    => 'nullable',
            'faktor3_nilai2'    => 'nullable',
            'faktor3_nilai3'    => 'nullable',
            'faktor3_nilai4'    => 'nullable',
        ]);


        $skoring = SkoringModel::find($request->id_skoring);
        $skoring->nama_kelompok     = $request->nama_kelompok;
        $skoring->faktor1_nilai1    = $request->faktor1_nilai1;
        $skoring->faktor1_nilai2    = $request->faktor1_nilai2;
        $skoring->faktor1_nilai3    = $request->faktor1_nilai3;
        $skoring->faktor1_nilai4    = $request->faktor1_nilai4;
        $skoring->faktor2_nilai1    = $request->faktor2_nilai1;
        $skoring->faktor2_nilai2    = $request->faktor2_nilai2;
        $skoring->faktor2_nilai3    = $request->faktor2_nilai3;
        $skoring->faktor2_nilai4    = $request->faktor2_nilai4;
        $skoring->faktor3_nilai1    = $request->faktor3_nilai1;
        $skoring->faktor3_nilai2    = $request->faktor3_nilai2;
        $skoring->faktor3_nilai3    = $request->faktor3_nilai3;
        $skoring->faktor3_nilai4    = $request->faktor3_nilai4;
        $skoring->us_ed             = Auth::user()->id;
        $skoring->save();


        return redirect('administrator/skoring')->with('pesan', 'Skoring telah diperbaharui !');
    }

    public function viewDeleteSkoring($id){
        return view('admin.admin.skoring.deleteskoring',compact('id'));
    }

    public function deleteSkoring($id){
        SkoringModel::destroy($id);
        return redirect('administrator/skoring')->with('pesan', 'Data Skoring telah dihapus !');
    }
}