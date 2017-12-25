<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsulanBappedaModel extends Model
{
    protected $table = "usulan_bappeda";
    protected $primaryKey = "id_usul_bappeda";

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function desa(){
		return $this->hasOne('App\Model\DesaModel','kd_desa', 'kd_desa');
	}

	public function distrik(){
		return $this->hasOne('App\Model\DistrikModel','kd_distrik', 'kd_distrik');
	}

	public function skpd(){
		return $this->hasOne('App\Model\SKPDModel','id_skpd', 'id_skpd');
	}

	public function fotodesa(){
		return $this->hasMany('App\Model\FotoModel','id_usul_desa', 'id_usul_desa');
	}
}
