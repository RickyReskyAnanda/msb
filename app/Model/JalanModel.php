<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JalanModel extends Model
{
    protected $table = 'jalan';
    protected $primaryKey = 'id_jalan';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function desa(){
		return $this->hasOne('App\Model\DesaModel','kd_desa', 'kd_desa');
	}
}
