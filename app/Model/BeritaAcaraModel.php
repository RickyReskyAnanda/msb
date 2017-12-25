<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BeritaAcaraModel extends Model
{
	protected $table = "ba_distrik";
	protected $primaryKey = "id_ba";

	const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function sambutan(){
		return $this->hasMany('App\Model\BeritaAcaraSambutanModel','id_ba', 'id_ba');
	}

	public function peserta(){
		return $this->hasMany('App\Model\BeritaAcaraAnggotaModel','id_ba', 'id_ba');
	}

	public function delegasi(){
		return $this->hasMany('App\Model\BeritaAcaraDelegasiModel','id_ba', 'id_ba');
	}

	public function distrik(){
		return $this->hasOne('App\Model\DistrikModel','kd_distrik','kd_distrik');
	}
}
