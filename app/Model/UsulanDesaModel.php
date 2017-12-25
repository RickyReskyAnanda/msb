<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsulanDesaModel extends Model
{
    protected $table = "usulan_desa";
    protected $primaryKey = "id_usul_desa";

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function foto(){
		return $this->hasMany('App\Model\FotoModel','id_usul_desa', 'id_usul_desa');
	}
	public function desa(){
		return $this->hasOne('App\Model\DesaModel','kd_desa', 'kd_desa');
	}
	public function distrik(){
		return $this->hasOne('App\Model\DistrikModel','kd_distrik', 'kd_distrik');
	}

	public function usulanDistrik(){
		return $this->hasOne('App\Model\UsulanDistrikModel','id_usul_desa', 'id_usul_desa');
	}
	public function usulanSKPD(){
		return $this->hasOne('App\Model\UsulanSKPDModel','id_usul_desa', 'id_usul_desa');
	}
}
