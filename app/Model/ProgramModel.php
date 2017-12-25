<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgramModel extends Model
{
    protected $table = 'tprogram';
    protected $primaryKey = 'id_prog';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function kegiatan(){
		return $this->hasMany('App\Model\KegiatanModel','nm_program','id_prog');
	}	

	// public function rkpd(){
	// 	return $this->hasMany('App\Model\RKPDModel','id_prog','id_prog');
	// }
}
