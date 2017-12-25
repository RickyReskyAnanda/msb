<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsulanDistrikModel extends Model
{
    protected $table = "usulan_distrik";
    protected $primaryKey = "id_usul_distrik";

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function fotodesa(){
		return $this->hasMany('App\Model\FotoModel','id_usul_desa', 'id_usul_desa');
	}

	public function usulanDesa(){
		return $this->hasOne('App\Model\UsulanDesaModel','id_usul_desa', 'id_usul_desa');
	}

	public function usulanSKPD(){
		return $this->hasOne('App\Model\UsulanSKPDModel','id_usul_desa', 'id_usul_desa');
	}

	public function kamusUsulan(){
		return $this->hasOne('App\Model\KamusUsulanModel','id_kegiatan', 'id_keg');
	}

	public function desa(){
		return $this->hasOne('App\Model\DesaModel','kd_desa', 'kd_desa');
	}

}
