<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RKPDModel extends Model
{
    protected $table = 'trkpd';
    protected $primaryKey = 'id_rkpd';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function program(){
		return $this->hasOne('App\Model\ProgramModel','id_prog','id_prog');
	}
	public function skpd(){
		return $this->hasOne('App\Model\SKPDModel','id_skpd','id_skpd');
	}

	public function rkpd(){
		return $this->hasMany('App\Model\RKPDModel','id_prog','id_prog');
	}
	public function kegiatan(){
		return $this->hasOne('App\Model\KegiatanModel','id_kegiatan','id_kegiatan');
	}

	public function bidang(){
		return $this->hasOne('App\Model\BidangModel','id_bidang','id_bidang');
	}

	public function hak(){
		return $this->hasMany('App\Model\HAKModel','id_kegiatan','id_kegiatan');
	}
}
