<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HAKModel extends Model
{
    protected $table = 'thak';
    protected $primaryKey = 'id_hak';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';
}
