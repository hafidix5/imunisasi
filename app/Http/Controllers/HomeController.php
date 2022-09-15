<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenis_imunisasi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $jenisImunisasis = jenis_imunisasi::pluck('id');
        
        $d=json_encode($jenisImunisasis->toArray());
        dd($d); */
        return view('home');
    }
}
