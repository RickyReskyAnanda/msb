<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FotoModel extends Model
{
    protected $table = "foto";
    protected $primaryKey = "id_foto";

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';
}
