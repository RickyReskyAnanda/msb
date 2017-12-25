<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KamusUsulanModel extends Model
{
    protected $table = "pekerjaan_list";
    protected $primaryKey = "id_pekerjaan";

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function skoring(){
		return $this->hasOne('App\Model\SkoringModel','id_skoring', 'id_skoring');
	}

}
