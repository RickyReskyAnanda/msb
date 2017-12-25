<?php

namespace App\Http\Controllers\RKPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasicController extends Controller
{
    public function viewBeranda(){
    	return view('rkpd.beranda');
    }
    public function viewRKPD(){
    	return view('rkpd.review-rkpd');
    }

    public function login(){
    	return view('rkpd.login');
    }
}
