<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    protected $table = 'trenstra_kegiatan';
    protected $primaryKey = 'id_kegiatan';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function rkpd(){
		return $this->hasOne('App\Model\RKPDModel', 'id_kegiatan', 'id_kegiatan');
	}

	public function program(){
		return $this->hasOne('App\Model\ProgramModel','id_prog','nm_program');
	}

}
