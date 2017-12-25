<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BappedaController extends Controller
{
    public function viewBeranda(){
    	return view('admin.bappeda.beranda');
    }
    public function viewKamusUsulan(){
    	return view('admin.bappeda.kamusUsulan');
    }
}
