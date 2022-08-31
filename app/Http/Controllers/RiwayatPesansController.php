<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ibu;
use App\Models\Pesans;
use App\Models\riwayat_pesans;
use Illuminate\Http\Request;
use Exception;

class RiwayatPesansController extends Controller
{

    /**
     * Display a listing of the riwayat pesans.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $riwayatPesansObjects = riwayat_pesans::with('pesan','ibu')->paginate(25);

        return view('riwayat_pesans.index', compact('riwayatPesansObjects'));
    }

    /**
     * Show the form for creating a new riwayat pesans.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Pesans = Pesans::pluck('jenis','id')->all();
        $Ibus = Ibu::pluck('nama','id')->all();
        
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
        $Pesans = Pesan::pluck('jenis','id')->all();
$Ibus = Ibu::pluck('id','id')->all();

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
