<?php

namespace App\Http\Controllers\Distrik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UsulanDistrikModel;
use App\Model\UsulanDesaModel;
use App\Model\FotoModel;
use App\Model\SKPDModel;
use App\Model\UsulanSKPDModel;
use App\Model\KamusUsulanModel;
use App\Model\DesaModel;
use App\Model\JalanModel;
use Auth;
use Image;
use File;
class UsulanDistrikController extends Controller
{
    public function viewUsulanMasuk(){
        $usulan = UsulanDistrikModel::where('sts_usulan','DIPROSES')->orWhere('sts_usulan','SIAP DIKIRIM')->where('kd_distrik',Auth::user()->kode_wilayah)->get();
        return view('admin.distrik.usulanmasuk',compact('usulan'));
    }
        public function komentarUsulan($status,$id){
            return view('admin.distrik.komentar',compact('status','id'));
        }

        public function postKomentarUsulan(Request $request){
            $this->validate($request,[
                'id_usul_distrik'       => 'required|numeric',
                'status'                => 'required',
                'komentar'              => 'required',
            ]);

            $distrik = UsulanDistrikModel::find($request->id_usul_distrik);


            if ($request->status == 'kembalikan') {
                $distrik->sts_usulan = "DITOLAK";
            }elseif($request->status =='kirim'){

                $skpd_pelaksana = SKPDModel::where('nm_skpd',$distrik->skpd_pelaksana)->first();

                $skpd = new UsulanSKPDModel; 
                $skpd->id_user               = $distrik->id_user;       
                $skpd->id_usul_desa          = $distrik->id_usul_desa;
                $skpd->id_keg                = $distrik->id_keg;      
                $skpd->id_pekerjaan          = $distrik->id_pekerjaan;      
                $skpd->tipe_keg              = $distrik->tipe_keg;      
                $skpd->bidang_urusan         = $distrik->bidang_urusan;
                $skpd->id_skpd               = $skpd_pelaksana->id_skpd;
                $skpd->kd_distrik            = $distrik->kd_distrik;
                $skpd->kd_desa               = $distrik->kd_desa;
                $skpd->skpd_pelaksana        = $distrik->skpd_pelaksana;
                $skpd->nama_pekerjaan        = $distrik->nama_pekerjaan;  
                $skpd->jalan                 = $distrik->jalan;         
                $skpd->ket_nomor             = $distrik->ket_nomor;     
                $skpd->ket_lokasi            = $distrik->ket_lokasi;    
                $skpd->link_maps            = $distrik->link_maps;    
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
                $skpd->keterangan_distrik    = $request->komentar;
                $skpd->sts_rpjmd             = $distrik->sts_rpjmd;
                $skpd->us_en                 = Auth::user()->name;
                $skpd->us_ed                 = Auth::user()->name;
                $skpd->save();

                $distrik->sts_usulan = "DIPROSES SKPD";
            }

            $distrik->keterangan_distrik = $request->komentar;
            $distrik->save();

            if ($request->status == 'kembalikan') {
                return redirect('distrik/usulan/ditolak')->with('pesan', 'Usulan telah dikembalikan ke Kampung !');
            }elseif($request->status =='kirim'){
                return redirect('distrik/usulan/dikirim')->with('pesan', 'Usulan telah dikirim ke SKPD terkait !');
            }
        }

    public function viewEditUsulan($id){
        $detail = UsulanDistrikModel::find($id);
        return view('admin.distrik.editusulan',compact('detail'));
    }

    public function postEditUsulan(Request $request){
        $this->validate($request,[
                'id_usul_distrik'   => 'required|numeric',
                'volume'            => 'required|numeric',
                'jalan'             => 'nullable',
                'ket_nomor'         => 'required|numeric',
                'ket_lokasi'        => 'required',
                'link_maps'        => 'required',
                'status_lahan'      => 'required',
                'keterangan'        => 'required',
            ]);
        $distrik = UsulanDistrikModel::find($request->id_usul_distrik);

        $distrik->volume        = $request->volume;
        $distrik->jalan         = $request->jalan;
        $distrik->ket_nomor     = $request->ket_nomor;
        $distrik->ket_lokasi    = $request->ket_lokasi;
        $distrik->link_maps     = $request->link_maps;
        $distrik->status_lahan  = $request->status_lahan;
        $distrik->sts_usulan    = 'SIAP DIKIRIM';
        $distrik->keterangan    = $request->keterangan;
        $distrik->save();

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

                $foto->id_usul_desa = $distrik->id_usul_desa;
                $foto->level_upload = 'DISTRIK';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('distrik/usulan/masuk')
                ->with('pesan', 'Usulan telah diperbaharui !');
    } 


    public function viewUsulanDikirim(){
        $usulan = UsulanDistrikModel::where('sts_usulan','DIPROSES SKPD')->where('kd_distrik',Auth::user()->kode_wilayah)->get();
        return view('admin.distrik.usulandikirim',compact('usulan'));
    }

    public function viewUsulanDitolak(){
        $usulan = UsulanDistrikModel::where('sts_usulan','DITOLAK')->where('kd_distrik',Auth::user()->kode_wilayah)->get();
        return view('admin.distrik.usulanditolak',compact('usulan'));
    }

    public function viewHapusGambarUsulan($id){
        return view('admin.distrik.deletegambar',compact('id'));
    }
    
    public function hapusGambarUsulan($id){
        $foto = FotoModel::find($id);

        $filename = public_path('images/usulan/'.$foto->file_foto);
        $filenamethumb = public_path('images/usulan/thumb/'.$foto->file_foto);
        File::delete([$filename, $filenamethumb]);
        $foto->delete();
        return redirect('distrik/usulan/masuk')->with('pesan','Gambar telah dihapus !');
    }

    public function viewPilihUsulan(){
        $data = KamusUsulanModel::all();
        return view('admin.distrik.pilihusulan',compact('data'));
    }

    public function viewInputUsulan($id){
        $usulan = KamusUsulanModel::find($id);
        $desa = DesaModel::where('kd_distrik',Auth::user()->kode_wilayah)->get();
        return view('admin.distrik.inputusulan',compact('usulan','desa'));
    }

    public function postInputUsulan(Request $request){

         $this->validate($request, [
            'id_kegiatan'   => 'required|numeric',
            'desa'          => 'required|numeric',
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
        $usulan = KamusUsulanModel::find($request->id_kegiatan);
        /*-----------------INPUT KE DESA--------------*/
        $desa = new UsulanDesaModel;
        $desa->tipe_keg         = $usulan->tipe_keg;
        $desa->id_user          = Auth::user()->id;
        $desa->kd_desa          = $request->desa;
        $desa->id_keg           = $request->id_kegiatan;
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
        $desa->sts_usulan       = 'Diproses kecamatan';

        
        $desa->save();
        /*--------------BATAS INPUT KE DESA--------------*/



        /*----------------INPUT KE DISTRIK------------------*/
        $distrik = new UsulanDistrikModel; 
        $distrik->id_user               = $desa->id_user;       
        $distrik->kd_distrik            = Auth::user()->kode_wilayah;     //dari user
        $distrik->kd_desa               = $desa->kd_desa;     //dari relasi user
        $distrik->id_usul_desa          = $desa->id_usul_desa;
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
        $distrik->sts_usulan            = 'SIAP DIKIRIM'; 
        $distrik->level                 = $desa->level;
        $distrik->sts_rpjmd             = $desa->sts_rpjmd;
        $distrik->save();

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
                $foto->level_upload = 'DISTRIK';
                $foto->file_foto    = $name;
                $foto->us_en        = Auth::user()->name;

                $foto->save();

            }
        }

        return redirect('distrik/usulan/masuk')
                ->with('pesan', 'Usulan '.$request->level.' telah ditambahkan !');

    }

    public function viewPantauUsulan(){
        $usulan = UsulanDistrikModel::where('kd_distrik',Auth::user()->kode_wilayah)->get();
        return view('admin.distrik.pantauusulan',compact('usulan'));
    }
}
