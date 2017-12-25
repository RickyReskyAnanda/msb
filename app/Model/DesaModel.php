<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DesaModel extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id_desa';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function userInput(){
		return $this->hasOne('App\User','id', 'us_en');
	}
	public function userEdit(){
		return $this->hasOne('App\User','id', 'us_ed');
	}
	public function jalan(){
		return $this->hasMany('App\Model\JalanModel','kd_desa', 'kd_desa');
	}
	public function distrik(){
		return $this->hasOne('App\Model\DistrikModel','kd_distrik','kd_distrik');
	}
}
