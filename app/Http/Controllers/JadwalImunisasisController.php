<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\jenis_imunisasi;
use App\Models\User;
use App\Models\jadwal_imunisasi;
use Illuminate\Http\Request;
use Exception;

class JadwalImunisasisController extends Controller
{

    /**
     * Display a listing of the jadwal imunisasis.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jadwalImunisasis = jadwal_imunisasi::with('jenisimunisasi','user')->paginate(25);

        return view('jadwal_imunisasis.index', compact('jadwalImunisasis'));
    }

    /**
     * Show the form for creating a new jadwal imunisasi.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $JenisImunisasis = jenis_imunisasi::pluck('nama','id')->all();
$Users = User::pluck('name','id')->all();
        
        return view('jadwal_imunisasis.create', compact('JenisImunisasis','Users'));
    }

    /**
     * Store a new jadwal imunisasi in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            jadwal_imunisasi::create($data);

            return redirect()->route('jadwal_imunisasis.jadwal_imunisasi.index')
                ->with('success_message', 'Jadwal Imunisasi was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified jadwal imunisasi.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $jadwalImunisasi = jadwal_imunisasi::with('jenisimunisasi','user')->findOrFail($id);

        return view('jadwal_imunisasis.show', compact('jadwalImunisasi'));
    }

    /**
     * Show the form for editing the specified jadwal imunisasi.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $jadwalImunisasi = jadwal_imunisasi::findOrFail($id);
        $JenisImunisasis = JenisImunisasi::pluck('nama','id')->all();
$Users = User::pluck('name','id')->all();

        return view('jadwal_imunisasis.edit', compact('jadwalImunisasi','JenisImunisasis','Users'));
    }

    /**
     * Update the specified jadwal imunisasi in the storage.
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
            
            $jadwalImunisasi = jadwal_imunisasi::findOrFail($id);
            $jadwalImunisasi->update($data);

            return redirect()->route('jadwal_imunisasis.jadwal_imunisasi.index')
                ->with('success_message', 'Jadwal Imunisasi was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified jadwal imunisasi from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $jadwalImunisasi = jadwal_imunisasi::findOrFail($id);
            $jadwalImunisasi->delete();

            return redirect()->route('jadwal_imunisasis.jadwal_imunisasi.index')
                ->with('success_message', 'Jadwal Imunisasi was successfully deleted.');
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
                'jenis_imunisasis_id' => 'required',
            'tempat' => 'required|string|min:1|max:50',
            'tanggal' => 'required|date_format:j/n/Y g:i A',
            'waktu_pemberian' => 'nullable|date_format:j/n/Y g:i A',
            'berat_badan' => 'nullable|numeric|min:-9|max:9',
            'panjang_badan' => 'nullable|numeric|min:-9|max:9',
            'suhu' => 'nullable|numeric|min:-9|max:9',
            'status' => 'nullable|string|min:0|max:30',
            'keterangan' => 'nullable|string|min:0|max:50',
            'users_id' => 'required', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
