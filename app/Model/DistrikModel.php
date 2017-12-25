<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DistrikModel extends Model
{
    protected $table = 'distrik';
    protected $primaryKey = 'id_distrik';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function userInput(){
		return $this->hasOne('App\User','id', 'us_en');
	}
	public function userEdit(){
		return $this->hasOne('App\User','id', 'us_ed');
	}
	public function desa(){
		return $this->hasMany('App\Model\DesaModel','kd_distrik', 'kd_distrik');
	}

	public function usulanSKPD(){
		return $this->hasMany('App\Model\UsulanSKPDModel','kd_distrik', 'kd_distrik');
	}
	
}
