<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\jenis_imunisasi;
use Illuminate\Http\Request;
use Exception;

class JenisImunisasisController extends Controller
{

    /**
     * Display a listing of the jenis imunisasis.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jenisImunisasis = jenis_imunisasi::paginate(25);

        return view('jenis_imunisasis.index', compact('jenisImunisasis'));
    }

    /**
     * Show the form for creating a new jenis imunisasi.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('jenis_imunisasis.create');
    }

    /**
     * Store a new jenis imunisasi in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            jenis_imunisasi::create($data);

            return redirect()->route('jenis_imunisasis.jenis_imunisasi.index')
                ->with('success_message', 'Jenis Imunisasi was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified jenis imunisasi.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $jenisImunisasi = jenis_imunisasi::findOrFail($id);

        return view('jenis_imunisasis.show', compact('jenisImunisasi'));
    }

    /**
     * Show the form for editing the specified jenis imunisasi.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $jenisImunisasi = jenis_imunisasi::findOrFail($id);
        

        return view('jenis_imunisasis.edit', compact('jenisImunisasi'));
    }

    /**
     * Update the specified jenis imunisasi in the storage.
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
            
            $jenisImunisasi = jenis_imunisasi::findOrFail($id);
            $jenisImunisasi->update($data);

            return redirect()->route('jenis_imunisasis.jenis_imunisasi.index')
                ->with('success_message', 'Jenis Imunisasi was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified jenis imunisasi from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $jenisImunisasi = jenis_imunisasi::findOrFail($id);
            $jenisImunisasi->delete();

            return redirect()->route('jenis_imunisasis.jenis_imunisasi.index')
                ->with('success_message', 'Jenis Imunisasi was successfully deleted.');
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
                'nama' => 'required|string|min:1|max:30',
            'waktu_tepat' => 'required',
            'waktu_telat' => 'required',
            'keterangan' => 'required|string|min:1|max:30', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
