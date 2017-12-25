<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnggaranPerubahanModel extends Model
{
    protected $table = 'trkpd_ap';
    protected $primaryKey = 'id_rkpd';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function skpd(){
		return $this->hasOne('App\Model\SKPDModel','id_skpd', 'id_skpd');
	}

	public function bidang(){
		return $this->hasOne('App\Model\BidangModel','id_bidang', 'id_bidang');
	}

	public function program(){
		return $this->hasOne('App\Model\ProgramModel','id_prog', 'id_prog');
	}
}
