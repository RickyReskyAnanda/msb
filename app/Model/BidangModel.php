<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BidangModel extends Model
{
    protected $table = 'tbidang';
    protected $primaryKey = 'id_bidang';

    const CREATED_AT = 'tgl_en';
	const UPDATED_AT = 'tgl_ed';
}
