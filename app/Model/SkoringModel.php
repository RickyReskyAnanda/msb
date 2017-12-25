<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SkoringModel extends Model
{
    protected $table = 'skoring';
    protected $primaryKey = 'id_skoring';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';

	public function userInput(){
		return $this->hasOne('App\User','id', 'us_en');
	}

	public function userEdit(){
		return $this->hasOne('App\User','id', 'us_ed');
	}
}
