<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BeritaAcaraSambutanModel extends Model
{
    protected $table = "ba_distrik_sambutan";
	protected $primaryKey = "id";

	const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';
}
