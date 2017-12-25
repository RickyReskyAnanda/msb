<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DesaModel;
use App\Model\DistrikModel;
use Auth;

class DesaController extends Controller
{
    public function viewDesa(){
        $data = DesaModel::all();
    	return view('admin.admin.datamaster.desa.desa',compact('data'));
    }

    public function viewAddDesa(){
        $distrik = DistrikModel::where('sts','Y')->orderBy('kd_distrik','asc')->get();
        return view('admin.admin.datamaster.desa.adddesa',compact('distrik'));
    }
    public function postAddDesa(Request $request){

        $this->validate($request, [
            'nm_desa'       => 'required',
            'kd_distrik'    => 'required|numeric',
            'sts'           => 'required',
        ]);

        $kd = DesaModel::max('kd_desa');
        if($kd==null){
            $kd =  '00001';
        }
        else{
            $pjg   = 5-strlen(++$kd);
            for($i=0;$i<$pjg;$i++){
                $kd = '0'.$kd;
            }
        }
        $desa = new DesaModel;
        $desa->nm_desa      = $request->nm_desa;
        $desa->kd_desa      = $kd;
        $desa->kd_distrik   = $request->kd_distrik;
        $desa->sts          = $request->sts;
        $desa->us_en        = Auth::user()->name;
        $desa->us_ed        = Auth::user()->name;
        $desa->save();

        return redirect('administrator/data-master/desa')->with('pesan', 'Kampung '.$request->nm_desa.' telah ditambahkan !');
    }


    public function viewEditDesa($id){
        $detail = DesaModel::find($id);
        $distrik = DistrikModel::where('sts','Y')->orderBy('kd_distrik','asc')->get();
        return view('admin.admin.datamaster.desa.editdesa',compact('detail','distrik'));
    }

    public function postEditDesa(Request $request){
        $this->validate($request, [
            'id_desa'       => 'required|numeric',
            'nm_desa'       => 'required',
            'kd_distrik'    => 'required|numeric',
            'sts'           => 'required',
        ]);


        $desa = DesaModel::find($request->id_desa);
        $desa->nm_desa      = $request->nm_desa;
        $desa->kd_distrik   = $request->kd_distrik;
        $desa->sts          = $request->sts;
        $desa->us_ed        = Auth::user()->name;
        $desa->save();

        return redirect('administrator/data-master/desa')->with('pesan', 'Kampung '.$request->nm_desa.' telah diperbaharui !');
    }

    public function viewDeleteDesa($id){
        return view('admin.admin.datamaster.desa.deletedesa',compact('id'));
    }

    public function deleteDesa($id){
        $desa = DesaModel::find($id);
        $nama = $desa->nm_desa;
        $desa->delete();
        return redirect('administrator/data-master/desa')->with('pesan', 'Data Kampung '.$nama.' telah dihapus !');
    }
}
