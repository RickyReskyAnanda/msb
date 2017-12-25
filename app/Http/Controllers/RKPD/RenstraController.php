<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RenstraController extends Controller
{
    public function viewRenstra(){
    	return view('rkpd.review-renstra');
    }
}
