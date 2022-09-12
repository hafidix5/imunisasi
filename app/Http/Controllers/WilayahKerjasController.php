<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\wilayah_kerjas;
use Illuminate\Http\Request;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class WilayahKerjasController extends Controller
{

    /**
     * Display a listing of the wilayah kerjas.
     *
     * @return Illuminate\View\View
     */

    function __construct()
    {
         $this->middleware('permission:wilayahkerjas-list|wilayahkerjas-create|wilayahkerjas-edit|wilayahkerjas-delete', ['only' => ['index','store']]);
         $this->middleware('permission:wilayahkerjas-create', ['only' => ['create','store']]);
         $this->middleware('permission:wilayahkerjas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:wilayahkerjas-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $wilayahKerjasObjects = wilayah_kerjas::paginate(25);

        return view('wilayah_kerjas.index', compact('wilayahKerjasObjects'));
    }

    /**
     * Show the form for creating a new wilayah kerjas.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('wilayah_kerjas.create');
    }

    /**
     * Store a new wilayah kerjas in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'wilayah_kerjas', 'length' => 5, 'prefix' =>'wk-']);
        try {
            
            $data = $this->getData($request);
            $data['id']=$id;
            wilayah_kerjas::create($data);

            return redirect()->route('wilayah_kerjas.wilayah_kerjas.index')
                ->with('success_message', 'Wilayah Kerjas was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified wilayah kerjas.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $wilayahKerjas = wilayah_kerjas::findOrFail($id);

        return view('wilayah_kerjas.show', compact('wilayahKerjas'));
    }

    /**
     * Show the form for editing the specified wilayah kerjas.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $wilayahKerjas = wilayah_kerjas::findOrFail($id);
        

        return view('wilayah_kerjas.edit', compact('wilayahKerjas'));
    }

    /**
     * Update the specified wilayah kerjas in the storage.
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
            
            $wilayahKerjas = wilayah_kerjas::findOrFail($id);
            $wilayahKerjas->update($data);

            return redirect()->route('wilayah_kerjas.wilayah_kerjas.index')
                ->with('success_message', 'Wilayah Kerjas was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified wilayah kerjas from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $wilayahKerjas = wilayah_kerjas::findOrFail($id);
            $wilayahKerjas->delete();

            return redirect()->route('wilayah_kerjas.wilayah_kerjas.index')
                ->with('success_message', 'Wilayah Kerjas was successfully deleted.');
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
            'nama' => 'required|string|min:1|max:30', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
