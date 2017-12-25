<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsulanSKPDModel extends Model
{
    protected $table = "usulan_skpd";
    protected $primaryKey = "id_usul_skpd";

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function fotodesa(){
		return $this->hasMany('App\Model\FotoModel','id_usul_desa', 'id_usul_desa');
	}

	public function usulanDesa(){
		return $this->hasOne('App\Model\UsulanDesaModel','id_usul_desa', 'id_usul_desa');
	}

	public function kamusUsulan(){
		return $this->hasOne('App\Model\KamusUsulanModel','id_kegiatan', 'id_keg');
	}

	public function distrik(){
		return $this->hasOne('App\Model\DistrikModel','kd_distrik','kd_distrik');
	}

	public function desa(){
		return $this->hasOne('App\Model\DesaModel','kd_desa', 'kd_desa');
	}
}
