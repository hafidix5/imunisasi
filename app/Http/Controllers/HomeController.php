<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenis_imunisasi;
use DB;

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
        $pesan_terkirim=DB::select('select COUNT(*) AS jumlah from jadwal_imunisasis where status_pesan=1');
        $imunisasi=DB::select('select COUNT(*) AS jumlah from jadwal_imunisasis AS j WHERE j.status!=""');
        $anak=DB::select('select COUNT(*) AS jumlah from anaks');
        $ibu=DB::select('select COUNT(*) AS jumlah from ibus');

        $jenisimuns=DB::select('SELECT COUNT(*) AS jumlah, j.nama AS nama  FROM jadwal_imunisasis AS ji JOIN jenis_imunisasis AS j ON ji.jenis_imunisasis_id=j.id GROUP BY ji.jenis_imunisasis_id');
        $anaks=DB::select('SELECT COUNT(*) AS jumlah, jenis_kelamin FROM anaks GROUP BY jenis_kelamin ORDER BY jenis_kelamin asc');
        $imunisasi_bulans=DB::select('SELECT COUNT(*) AS jumlah,month(ji.waktu_pemberian) AS bulan FROM jadwal_imunisasis AS ji JOIN anaks AS a ON ji.anaks_id=a.id WHERE ji.status!=""  GROUP BY month(ji.waktu_pemberian)');
        $tepat_waktus=DB::select('SELECT COUNT(*) AS jumlah,status FROM jadwal_imunisasis AS ji GROUP BY STATUS ORDER BY STATUS asc');
        
        return view('home', compact('pesan_terkirim','imunisasi','anak','ibu','jenisimuns','anaks','imunisasi_bulans','tepat_waktus'));
    }
}
