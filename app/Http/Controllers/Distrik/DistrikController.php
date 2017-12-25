<?php

namespace App\Http\Controllers\Distrik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrikController extends Controller
{
    public function viewBeranda(){
    	return view('admin.distrik.beranda');
    }
}
