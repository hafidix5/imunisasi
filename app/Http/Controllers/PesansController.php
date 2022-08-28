<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\pesans;
use Illuminate\Http\Request;
use Exception;

class PesansController extends Controller
{

    /**
     * Display a listing of the pesans.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $pesansObjects = pesans::paginate(25);

        return view('pesans.index', compact('pesansObjects'));
    }

    /**
     * Show the form for creating a new pesans.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pesans.create');
    }

    /**
     * Store a new pesans in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            pesans::create($data);

            return redirect()->route('pesans.pesans.index')
                ->with('success_message', 'Pesans was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified pesans.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $pesans = pesans::findOrFail($id);

        return view('pesans.show', compact('pesans'));
    }

    /**
     * Show the form for editing the specified pesans.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $pesans = pesans::findOrFail($id);
        

        return view('pesans.edit', compact('pesans'));
    }

    /**
     * Update the specified pesans in the storage.
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
            
            $pesans = pesans::findOrFail($id);
            $pesans->update($data);

            return redirect()->route('pesans.pesans.index')
                ->with('success_message', 'Pesans was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified pesans from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $pesans = pesans::findOrFail($id);
            $pesans->delete();

            return redirect()->route('pesans.pesans.index')
                ->with('success_message', 'Pesans was successfully deleted.');
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
                'jenis' => 'required|string|min:1|max:20',
            'pesan' => 'required|string|min:1|max:160', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
