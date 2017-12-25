<?php

namespace App\Http\Controllers\Desa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JalanModel;
use App\Model\KamusUsulanModel;
use App\Model\UsulanDesaModel;
use App\Model\UsulanDistrikModel;
use App\Model\FotoModel;
use App\Model\DesaModel;
use Auth;
use Image;
use File;

class UsulanDesaController extends Controller
{

    public function viewUsulan(){
        $usulan = UsulanDesaModel::where('kd_desa',Auth::user()->kode_wilayah)->get();
        return view('admin.desa.usulan',compact('usulan'));
    }
    public function viewPantauUsulan(){
        $usulan = UsulanDesaModel::where('kd_desa',Auth::user()->kode_wilayah)->get();
    	return view('admin.desa.pantauUsulan',compact('usulan'));
    }
    public function viewPilihUsulan(){
        $data = KamusUsulanModel::all();
        return view('admin.desa.pilihUsulan',compact('data'));
    }
    public function viewInputUsulan($id){
        $usulan = KamusUsulanModel::find($id);

        $jalan = JalanModel::where('kd_desa',Auth::user()->kode_wilayah)->get();

        $jmlutama = UsulanDesaModel::where('kd_desa',Auth::user()->kode_wilayah)->where('level','UTAMA')->count();
        $jmlcadangan = UsulanDesaModel::where('kd_desa',Auth::user()->kode_wilayah)->where('level','CADANGAN')->count();
        return view('admin.desa.inputUsulan',compact('jalan','usulan','jmlutama','jmlcadangan'));
    }
    public function postInputUsulan(Request $request){
        $this->validate($request, [
            'id_pekerjaan'   => 'required|numeric',
            'volume'        => 'required|numeric',
            'ket_nomor'     => 'required|numeric',
            'ket_lokasi'    => 'required',
            'link_maps'     => 'required',
            'status_lahan'  => 'required',
            'keterangan'    => 'required',
            'faktor1'       => 'required|numeric',
            'faktor2'       => 'required|numeric',
            'faktor3'       => 'required|numeric',
            'cp_nama'       => 'required',
            'cp_alamat'     => 'required',
            'cp_telp'       => 'required',
            'cp_hp'         => 'required',
        ]);
        $usulan = KamusUsulanModel::find($request->id_pekerjaan);

        $desa = new UsulanDesaModel;
        $desa->tipe_keg         = $usulan->tipe_keg;
        $desa->id_user          = Auth::user()->id;
        $desa->kd_desa          = Auth::user()->kode_wilayah;
        if(isset($usulan->id_kegiatan)){
            $desa->id_keg           = $usulan->id_kegiatan;
        }
        $desa->skpd_pelaksana   = $usulan->skpd_pelaksana;
        $desa->nm_pekerjaan     = $usulan->nama_pekerjaan;
        $desa->jalan            = $request->jalan;
        $desa->ket_nomor        = $request->ket_nomor;
        $desa->ket_lokasi       = $request->ket_lokasi;
        $desa->link_maps        = $request->link_maps;
        $desa->status_lahan     = $request->status_lahan;
        $desa->level            = $request->level_usulan;
        $desa->harga            = $usulan->harga;
        $desa->satuan           = $usulan->satuan;
        $desa->volume           = $request->volume;
        $desa->tgl_usulan       = date('Y-m-d h:i:s');

        if ($request->faktor1 == '1')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai1;
        elseif ($request->faktor1 == '2')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai2;
        elseif ($request->faktor1 == '3')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai3;
        elseif ($request->faktor1 == '4')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai4;


        if ($request->faktor2 == '1')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai1;
        elseif ($request->faktor2 == '2')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai2;
        elseif ($request->faktor2 == '3')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai3;
        elseif ($request->faktor2 == '4')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai4;

        if ($request->faktor3 == '1')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai1;
        elseif ($request->faktor3 == '2')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai2;
        elseif ($request->faktor3 == '3')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai3;
        elseif ($request->faktor3 == '4')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai4;

        $desa->nilai1           = $request->faktor1;
        $desa->nilai2           = $request->faktor2;
        $desa->nilai3           = $request->faktor3;

        $skor = ($desa->nilai1+$desa->nilai2+$desa->nilai3)/3;
        $desa->skor             = $skor;

        $desa->keterangan       = $request->keterangan;

        $desa->cp_nama          = $request->cp_nama;
        $desa->cp_alamat        = $request->cp_alamat;
        $desa->cp_telp          = $request->cp_telp;
        $desa->cp_hp            = $request->cp_hp;
        $desa->sts_rpjmd        = $usulan->sts_rpjmd;
        $desa->sts_usulan       = 'Proses';

        
        $desa->save();

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

                $foto->id_usul_desa = $desa->id_usul_desa;
                $foto->level_upload = 'DESA';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('desa/usulan')
                ->with('pesan', 'Usulan '.$request->level.' telah ditambahkan !');
    }

    public function viewEditUsulan($id){
        $detail = UsulanDesaModel::find($id);

        $usulan = KamusUsulanModel::find($detail->id_pekerjaan);
        $jalan = JalanModel::where('kd_desa',Auth::user()->kode_wilayah)->get();

        return view('admin.desa.editUsulan',compact('jalan','usulan','detail'));
    }

    public function postEditUsulan(Request $request){
        $this->validate($request, [
            'id_usul'       => 'required|numeric',
            'id_pekerjaan'  => 'required|numeric',
            'volume'        => 'required|numeric',
            'ket_nomor'     => 'required|numeric',
            'ket_lokasi'    => 'required',
            'link_maps'     => 'required',
            'status_lahan'  => 'required',
            'keterangan'    => 'required',
            'faktor1'       => 'required|numeric',
            'faktor2'       => 'required|numeric',
            'faktor3'       => 'required|numeric',
            'cp_nama'       => 'required',
            'cp_alamat'     => 'required',
            'cp_telp'       => 'required',
            'cp_hp'         => 'required',
        ]);
        $usulan = KamusUsulanModel::find($request->id_pekerjaan);
        $desa   = UsulanDesaModel::find($request->id_usul);

        $desa->jalan            = $request->jalan;
        $desa->ket_nomor        = $request->ket_nomor;
        $desa->ket_lokasi       = $request->ket_lokasi;
        $desa->link_maps        = $request->link_maps;
        $desa->status_lahan     = $request->status_lahan;
        $desa->harga            = $usulan->harga;
        $desa->satuan           = $usulan->satuan;
        $desa->volume           = $request->volume;

        if ($request->faktor1 == '1')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai1;
        elseif ($request->faktor1 == '2')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai2;
        elseif ($request->faktor1 == '3')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai3;
        elseif ($request->faktor1 == '4')
            $desa->faktor1 = $usulan->skoring->faktor1_nilai4;


        if ($request->faktor2 == '1')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai1;
        elseif ($request->faktor2 == '2')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai2;
        elseif ($request->faktor2 == '3')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai3;
        elseif ($request->faktor2 == '4')
            $desa->faktor2 = $usulan->skoring->faktor2_nilai4;

        if ($request->faktor3 == '1')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai1;
        elseif ($request->faktor3 == '2')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai2;
        elseif ($request->faktor3 == '3')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai3;
        elseif ($request->faktor3 == '4')
            $desa->faktor3 = $usulan->skoring->faktor3_nilai4;

        $desa->nilai1           = $request->faktor1;
        $desa->nilai2           = $request->faktor2;
        $desa->nilai3           = $request->faktor3;

        $skor = ($desa->nilai1+$desa->nilai2+$desa->nilai3)/3;
        $desa->skor             = $skor;

        $desa->keterangan       = $request->keterangan;

        $desa->cp_nama          = $request->cp_nama;
        $desa->cp_alamat        = $request->cp_alamat;
        $desa->cp_telp          = $request->cp_telp;
        $desa->cp_hp            = $request->cp_hp;

        
        $desa->save();

        if($request->file('foto')){
            $fotodata = FotoModel::where('id_usul_desa',$desa->id_usul_desa)->get();

            foreach($fotodata as $fd){
                $filename = public_path('images/usulan/'.$fd->file_foto);
                $filenamethumb = public_path('images/usulan/thumb/'.$fd->file_foto);
                File::delete([$filename, $filenamethumb]);
            }
            $fotodata = FotoModel::where('id_usul_desa',$desa->id_usul_desa)->delete();

            $i=0;
            foreach($request->file('foto') as $file){

                $name = date('Ymdhis').$i++.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/usulan/'),$name);

                //resize image
                $pathFind = public_path('images/usulan/'.$name);
                $pathSave = public_path('images/usulan/thumb/'.$name);
                Image::make($pathFind)->resize(null, 200, function ($constraint){$constraint->aspectRatio();})->save($pathSave);


                $foto = new FotoModel;

                $foto->id_usul_desa = $desa->id_usul_desa;
                $foto->level_upload = 'DESA';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('desa/usulan')
                ->with('pesan', 'Usulan '.$request->level.' telah diperbaharui !');
    }

    public function kirimUsulan($id){
        $desa = UsulanDesaModel::find($id);
        $kamususulan = KamusUsulanModel::find($desa->id_pekerjaan);

        $kd_distrik = DesaModel::where('kd_desa',(Auth::user()->kode_wilayah))->first();

        // return $kd_distrik;
        $distrik = new UsulanDistrikModel; 
        $distrik->id_user               = $desa->id_user;       
        $distrik->kd_distrik            = $kd_distrik->kd_distrik;     //dari relasi user
        $distrik->kd_desa               = $desa->kd_desa;     //dari relasi user
        $distrik->id_usul_desa          = $desa->id_usul_desa;
        $distrik->id_keg                = $desa->id_keg;      
        $distrik->id_pekerjaan          = $desa->id_pekerjaan;      
        $distrik->tipe_keg              = $desa->tipe_keg;      
        $distrik->bidang_urusan         = $kamususulan->bidang_urusan;
        $distrik->skpd_pelaksana        = $desa->skpd_pelaksana;
        $distrik->nama_pekerjaan        = $desa->nm_pekerjaan;  
        $distrik->jalan                 = $desa->jalan;         
        $distrik->ket_nomor             = $desa->ket_nomor;     
        $distrik->ket_lokasi            = $desa->ket_lokasi;    
        $distrik->link_maps             = $desa->link_maps;    
        $distrik->status_lahan          = $desa->status_lahan;  
        $distrik->harga                 = $desa->harga;         
        $distrik->satuan                = $desa->satuan;        
        $distrik->volume                = $desa->volume;        
        $distrik->tgl_usulan            = $desa->tgl_usulan;   // ini pada saat dikirim  
        $distrik->faktor1               = $desa->faktor1;        
        $distrik->faktor2               = $desa->faktor2;        
        $distrik->faktor3               = $desa->faktor3; 
        $distrik->nilai1                = $desa->nilai1;        
        $distrik->nilai2                = $desa->nilai2;        
        $distrik->nilai3                = $desa->nilai3;        
        $distrik->skor                  = $desa->skor;        
        $distrik->keterangan            = $desa->keterangan;        
        $distrik->cp_nama               = $desa->cp_nama;        
        $distrik->cp_alamat             = $desa->cp_alamat;        
        $distrik->cp_telp               = $desa->cp_telp;        
        $distrik->cp_hp                 = $desa->cp_hp;   
        $distrik->sts_usulan            = 'DIPROSES'; 
        $distrik->level                 = $desa->level;
        $distrik->sts_rpjmd             = $desa->sts_rpjmd;
        $distrik->save();

        $desa->sts_usulan = "Diproses distrik";
        $desa->save();


        return redirect('desa/usulan')->with('pesan', 'Usulan telah dikirim ke distrik dan tidak dapat dihapus !');
    }

    public function hapusUsulan($id){
        $usulan = UsulanDesaModel::find($id);

        if($usulan->sts_usulan!='Proses'){
            return redirect()->back()->with('peringatan', 'Usulan telah dikirim ke distrik dan tidak dapat dihapus !');
        }

        $foto = FotoModel::where('id_usul_desa',$id)->where('level_upload','DESA')->get();

        foreach ($foto as $ft) {
            $filename = public_path('images/usulan/'.$ft->file_foto);
            $filenamethumb = public_path('images/usulan/thumb/'.$ft->file_foto);
            File::delete([$filename, $filenamethumb]);
        }

        FotoModel::where('id_usul_desa',$id)->where('level_upload','DESA')->delete();
        UsulanDesaModel::destroy($id);

        return redirect('desa/usulan')
                ->with('pesan', 'Usulan '.$usulan->nm_pekerjaan.' telah dihapus !');

    }
}
