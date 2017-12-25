<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PokokPikiranDPRDModel extends Model
{
    protected $table = 'pokir_dprd';
    protected $primaryKey = 'id_pokir';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';
}
