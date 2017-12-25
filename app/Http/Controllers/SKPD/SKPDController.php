<?php

namespace App\Http\Controllers\SKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SKPDController extends Controller
{
    public function viewBeranda(){
    	return view('admin.skpd.beranda');
    }
}
