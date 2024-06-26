<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ibu;
use App\Models\pesans;
use App\Models\riwayat_pesans;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class RiwayatPesansController extends Controller
{

    /**
     * Display a listing of the riwayat pesans.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        //$riwayatPesansObjects = riwayat_pesans::with('pesan','ibu')->paginate(25);
        $riwayatPesansObjects=DB::select('SELECT p.jenis, i.nama AS ibu,i.id_telegram,a.nama AS anak,jj.nama,ji.tanggal,ji.tempat,ji.status_pesan,ji.id FROM jadwal_imunisasis AS ji JOIN anaks AS a ON ji.anaks_id=a.id JOIN ibus AS i ON a.ibus_id=i.id JOIN pesans AS p ON ji.pesans_id=p.id
        JOIN jenis_imunisasis AS jj ON ji.jenis_imunisasis_id=jj.id WHERE ji.status_pesan=?',['1']);

        return view('riwayat_pesans.index', compact('riwayatPesansObjects'));
    }

    /**
     * Show the form for creating a new riwayat pesans.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Pesans = pesans::pluck('jenis','id')->all();
        $Ibus = ibu::pluck('nama','id')->all();
        
        return view('riwayat_pesans.create', compact('Pesans','Ibus'));
    }

    /**
     * Store a new riwayat pesans in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            riwayat_pesans::create($data);

            return redirect()->route('riwayat_pesans.riwayat_pesans.index')
                ->with('success_message', 'Riwayat Pesans was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified riwayat pesans.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $riwayatPesans = riwayat_pesans::with('pesan','ibu')->findOrFail($id);

        return view('riwayat_pesans.show', compact('riwayatPesans'));
    }

    /**
     * Show the form for editing the specified riwayat pesans.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $riwayatPesans = riwayat_pesans::findOrFail($id);
        $Pesans = pesan::pluck('jenis','id')->all();
$Ibus = ibu::pluck('id','id')->all();

        return view('riwayat_pesans.edit', compact('riwayatPesans','Pesans','Ibus'));
    }

    /**
     * Update the specified riwayat pesans in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $riwayatPesans = riwayat_pesans::findOrFail($id);
            $riwayatPesans->update($data);

            return redirect()->route('riwayat_pesans.riwayat_pesans.index')
                ->with('success_message', 'Riwayat Pesans was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified riwayat pesans from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $riwayatPesans = riwayat_pesans::findOrFail($id);
            $riwayatPesans->delete();

            return redirect()->route('riwayat_pesans.riwayat_pesans.index')
                ->with('success_message', 'Riwayat Pesans was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'pesans_id' => 'required',
            'ibus_id' => 'required', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
