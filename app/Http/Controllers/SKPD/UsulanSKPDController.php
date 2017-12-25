<?php

namespace App\Http\Controllers\SKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DistrikModel;
use App\Model\SKPDModel;
use App\Model\FotoModel;
use App\Model\DesaModel;
use App\Model\KamusUsulanModel;
use App\Model\UsulanDesaModel;
use App\Model\UsulanDistrikModel;
use App\Model\UsulanSKPDModel;
use App\Model\UsulanBappedaModel;
use FIle;
use Image;
use Auth;


class UsulanSKPDController extends Controller
{
    public function viewVerifikasi(Request $request){

        $distrik = DistrikModel::all();
        $usulan  = array();

        $skpd = SKPDModel::where('id_skpd',Auth::user()->kode_wilayah)->first();


        if (isset($request->desa) && isset($request->tipe)) {
            if($request->desa==0 && $request->tipe==0)
                $usulan = UsulanSKPDModel::where('skpd_pelaksana',$skpd->nm_skpd)->paginate(10);
            elseif($request->desa==0)
                $usulan = UsulanSKPDModel::where('skpd_pelaksana',$skpd->nm_skpd)->where('tipe_keg',$request->tipe)->get();
            elseif($request->tipe==0)
                $usulan = UsulanSKPDModel::where('skpd_pelaksana',$skpd->nm_skpd)->where('kd_desa',$request->desa)->get();
            else
                $usulan = UsulanSKPDModel::where('kd_desa',$request->desa)->where('tipe_keg',$request->tipe)->where('skpd_pelaksana',$skpd->nm_skpd)->get();
        }else{
            $usulan = UsulanSKPDModel::where('skpd_pelaksana',$skpd->nm_skpd)->paginate(10);
        }

        return view('admin.skpd.verifikasi',compact('distrik','usulan','request'));
    }
    
    public function viewBeritaAcara(){
        return view('admin.skpd.beritaAcara');
    }

    public function alasanVerifikasi($persetujuan,$id){
        return view('admin.skpd.alasan',compact('persetujuan','id'));
    }

    public function postVerifikasi(Request $request){
        $skpd = UsulanSKPDModel::find($request->id_usul_skpd);
        if($request->persetujuan == 'terima'){
            $skpd->sts_usulan = 'SETUJU';

            $bappeda = new UsulanBappedaModel;
            $bappeda->id_user               = $skpd->id_user;

            $bappeda->id_skpd               = Auth::user()->kode_wilayah;     //dari user
            $bappeda->kd_distrik            = $skpd->kd_distrik;     
            $bappeda->kd_desa               = $skpd->kd_desa;     
            $bappeda->id_usul_desa          = $skpd->id_usul_desa;
            $bappeda->id_keg                = $skpd->id_keg;      
            $bappeda->id_pekerjaan          = $skpd->id_pekerjaan;      
            $bappeda->tipe_keg              = $skpd->tipe_keg;      
            $bappeda->bidang_urusan         = $skpd->bidang_urusan;
            $bappeda->skpd_pelaksana        = $skpd->skpd_pelaksana;
            $bappeda->nama_pekerjaan        = $skpd->nama_pekerjaan;  
            $bappeda->jalan                 = $skpd->jalan;         
            $bappeda->ket_nomor             = $skpd->ket_nomor;     
            $bappeda->ket_lokasi            = $skpd->ket_lokasi;    
            $bappeda->link_maps             = $skpd->link_maps;    
            $bappeda->status_lahan          = $skpd->status_lahan;  
            $bappeda->harga                 = $skpd->harga;         
            $bappeda->satuan                = $skpd->satuan;        
            $bappeda->volume                = $skpd->volume;        
            $bappeda->tgl_usulan            = $skpd->tgl_usulan;   // ini pada saat dikirim  
            $bappeda->faktor1               = $skpd->faktor1;        
            $bappeda->faktor2               = $skpd->faktor2;        
            $bappeda->faktor3               = $skpd->faktor3; 
            $bappeda->nilai1                = $skpd->nilai1;        
            $bappeda->nilai2                = $skpd->nilai2;        
            $bappeda->nilai3                = $skpd->nilai3;        
            $bappeda->skor                  = $skpd->skor;        
            $bappeda->keterangan            = $skpd->keterangan;        
            $bappeda->cp_nama               = $skpd->cp_nama;        
            $bappeda->cp_alamat             = $skpd->cp_alamat;        
            $bappeda->cp_telp               = $skpd->cp_telp;        
            $bappeda->cp_hp                 = $skpd->cp_hp;   
            $bappeda->sts_usulan            = 'DIPROSES BAPPEDA'; 
            $bappeda->level                 = $skpd->level;
            $bappeda->keterangan_skpd       = $request->alasan;
            $bappeda->sts_rpjmd             = $skpd->sts_rpjmd;

            $bappeda->save();

        }elseif ($request->persetujuan == 'tolak') {
            $skpd->sts_usulan = 'DITOLAK'; 
        }

        $skpd->verif_alasan = $request->alasan;
        $skpd->save();


        return redirect('skpd/verifikasi?desa='.$skpd->kd_desa.'&tipe='.$skpd->tipe_keg)
                ->with('pesan', 'Usulan SKPD telah diverifikasi dan dikirim ke BAPPEDA !');
    }

    public function viewEditUsulan($id){
        $detail = UsulanSKPDModel::find($id);
        return view('admin.skpd.editusulan',compact('detail'));
    }

    public function postEditUsulan(Request $request){
        $this->validate($request,[
                'id_usul_skpd'   => 'required|numeric',
                'volume'            => 'required|numeric',
                'jalan'             => 'nullable',
                'ket_nomor'         => 'required|numeric',
                'ket_lokasi'        => 'required',
                'link_maps'        => 'required',
                'status_lahan'      => 'required',
                'keterangan'        => 'required',
            ]);
        $skpd = UsulanSKPDModel::find($request->id_usul_skpd);

        $skpd->volume        = $request->volume;
        $skpd->jalan         = $request->jalan;
        $skpd->ket_nomor     = $request->ket_nomor;
        $skpd->ket_lokasi    = $request->ket_lokasi;
        $skpd->link_maps     = $request->link_maps;
        $skpd->status_lahan  = $request->status_lahan;
        $skpd->keterangan    = $request->keterangan;
        $skpd->save();

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

                $foto->id_usul_desa = $skpd->id_usul_desa;
                $foto->level_upload = 'SKPD';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('skpd/verifikasi?desa='.$skpd->kd_desa.'&tipe='.$skpd->tipe_keg)
                ->with('pesan', 'Usulan '.$request->level.' telah diperbaharui !');
    }

    public function viewPilihUsulan(){
        $data = KamusUsulanModel::all();
        return view('admin.skpd.pilihusulan',compact('data'));
    }

    public function viewInputUsulan($id){
        $usulan = KamusUsulanModel::find($id);
        $distrik = DistrikModel::all();
        return view('admin.skpd.inputusulan',compact('usulan','distrik'));
    }

    public function postInputUsulan(Request $request){
         $this->validate($request, [
            'distrik'       => 'required|numeric',
            'desa'          => 'required|numeric',
            'level_usulan'  => 'required',
            'id_pekerjaan'  => 'required|numeric',
            'volume'        => 'required|numeric',
            'jalan'         => 'nullable',
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
            'cp_hp'         => 'nullable',
        ]);

        
        $usulan = KamusUsulanModel::find($request->id_pekerjaan);
        $skpd = SKPDModel::where('id_skpd',Auth::user()->kode_wilayah)->first();
        /*-----------------INPUT KE DESA--------------*/
        $desa = new UsulanDesaModel;
        $desa->tipe_keg         = $usulan->tipe_keg;
        $desa->id_user          = Auth::user()->id;
        $desa->kd_desa          = $request->desa;
        $desa->id_pekerjaan     = $request->id_pekerjaan;
        $desa->id_keg           = $usulan->id_kegiatan;
        $desa->skpd_pelaksana   = $skpd->nm_skpd;
        $desa->nm_pekerjaan     = $usulan->nama_pekerjaan;
        $desa->jalan            = $request->jalan;
        $desa->ket_nomor        = $request->ket_nomor;
        $desa->ket_lokasi       = $request->ket_lokasi;
        $desa->link_maps        = $request->link_maps;
        $desa->status_lahan     = $request->status_lahan;
        $desa->level            = $request->level_usulan;
        $desa->harga            = $usulan->harga_satuan;
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
        $desa->sts_usulan       = 'Diproses distrik';

        
        $desa->save();
        /*--------------BATAS INPUT KE DESA--------------*/


        /*----------------INPUT KE DISTRIK------------------*/


        $datadesa = DesaModel::where('kd_desa',$request->desa)->first();



        $distrik = new UsulanDistrikModel; 
        $distrik->id_user               = $desa->id_user;       
        $distrik->kd_distrik            = $datadesa->distrik->kd_distrik;     //dari user
        $distrik->kd_desa               = $desa->kd_desa;     //dari relasi user
        $distrik->id_usul_desa          = $desa->id_usul_desa;
        $distrik->id_pekerjaan          = $desa->id_pekerjaan;      
        $distrik->id_keg                = $desa->id_keg;      
        $distrik->tipe_keg              = $desa->tipe_keg;      
        $distrik->bidang_urusan         = $usulan->bidang_urusan;
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
        $distrik->sts_usulan            = 'DIPROSES SKPD'; 
        $distrik->level                 = $desa->level;
        $distrik->sts_rpjmd             = $desa->sts_rpjmd;
        $distrik->save();


        $skpd = new UsulanSKPDModel; 
        $skpd->id_user               = $distrik->id_user;       
        $skpd->id_skpd               = Auth::user()->kode_wilayah;       
        $skpd->kd_distrik            = $distrik->kd_distrik;     //dari user
        $skpd->kd_desa               = $distrik->kd_desa;     //dari relasi user
        $skpd->id_usul_desa          = $distrik->id_usul_desa;
        $skpd->id_pekerjaan          = $distrik->id_pekerjaan;      
        $skpd->id_keg                = $distrik->id_keg;      
        $skpd->tipe_keg              = $distrik->tipe_keg;      
        $skpd->bidang_urusan         = $distrik->bidang_urusan;
        $skpd->skpd_pelaksana        = $distrik->skpd_pelaksana;
        $skpd->nama_pekerjaan        = $distrik->nama_pekerjaan;  
        $skpd->jalan                 = $distrik->jalan;         
        $skpd->ket_nomor             = $distrik->ket_nomor;     
        $skpd->ket_lokasi            = $distrik->ket_lokasi;    
        $skpd->link_maps             = $distrik->link_maps;    
        $skpd->status_lahan          = $distrik->status_lahan;  
        $skpd->harga                 = $distrik->harga;         
        $skpd->satuan                = $distrik->satuan;        
        $skpd->volume                = $distrik->volume;        
        $skpd->tgl_usulan            = $distrik->tgl_usulan;   // ini pada saat dikirim  
        $skpd->faktor1               = $distrik->faktor1;        
        $skpd->faktor2               = $distrik->faktor2;        
        $skpd->faktor3               = $distrik->faktor3; 
        $skpd->nilai1                = $distrik->nilai1;        
        $skpd->nilai2                = $distrik->nilai2;        
        $skpd->nilai3                = $distrik->nilai3;        
        $skpd->skor                  = $distrik->skor;        
        $skpd->keterangan            = $distrik->keterangan;        
        $skpd->cp_nama               = $distrik->cp_nama;        
        $skpd->cp_alamat             = $distrik->cp_alamat;        
        $skpd->cp_telp               = $distrik->cp_telp;        
        $skpd->cp_hp                 = $distrik->cp_hp;   
        $skpd->sts_usulan            = 'DIPROSES SKPD'; 
        $skpd->level                 = $distrik->level;
        $skpd->sts_rpjmd             = $distrik->sts_rpjmd;
        $skpd->save();

        /*----------------BATAS INPUT KE DISTRIK*/

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
                $foto->level_upload = 'SKPD';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('skpd/verifikasi')
                ->with('pesan', 'Usulan '.$skpd->level.' telah ditambahkan !');
    }
}
