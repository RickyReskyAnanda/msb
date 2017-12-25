<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JasmaraModel extends Model
{
   	protected $table = 'jasmara';
    protected $primaryKey = 'id_jasmara';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function distrik(){
		return $this->hasOne('App\Model\DistrikModel','id_distrik','id_distrik');
	}
	public function desa(){
		return $this->hasOne('App\Model\DesaModel','id_desa', 'id_desa');
	}

}
