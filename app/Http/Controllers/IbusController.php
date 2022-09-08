<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\wilayah_kerjas;
use App\Models\ibu;
use Illuminate\Http\Request;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Telegram\Bot\Laravel\Facades\Telegram;

class IbusController extends Controller
{

    /**
     * Display a listing of the ibus.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $ibus = ibu::with('wilayahkerja')->paginate(25);

        return view('ibus.index', compact('ibus'));
    }

    /**
     * Show the form for creating a new ibu.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $WilayahKerjas = wilayah_kerjas::pluck('jenis','id')->all();
        
        return view('ibus.create', compact('WilayahKerjas'));
    }

    /**
     * Store a new ibu in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'ibus', 'length' => 7, 'prefix' =>'ib-']);
        try {
            
            $data = $this->getData($request);
            $data['id']=$id;
            ibu::create($data);

            return redirect()->route('ibus.ibu.index')
                ->with('success_message', 'Ibu was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified ibu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $ibu = ibu::with('wilayahkerja')->findOrFail($id);

        return view('ibus.show', compact('ibu'));
    }

    /**
     * Show the form for editing the specified ibu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $ibu = ibu::findOrFail($id);
        $WilayahKerjas = wilayah_kerjas::pluck('jenis','id')->all();
        $activitys = Telegram::getUpdates();
        foreach ($activitys as $activity) {
            if($activity->message->text=="085274503739")
            {
                $idtele=$activity->message->chat->id;
            }            
        }
        

        return view('ibus.edit', compact('ibu','WilayahKerjas','idtele'));
    }

    /**
     * Update the specified ibu in the storage.
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
            
            $ibu = ibu::findOrFail($id);
            $ibu->update($data);

            return redirect()->route('ibus.ibu.index')
                ->with('success_message', 'Ibu was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified ibu from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $ibu = ibu::findOrFail($id);
            $ibu->delete();

            return redirect()->route('ibus.ibu.index')
                ->with('success_message', 'Ibu was successfully deleted.');
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
            'tgl_lahir' => 'required',
            'no_hp' => 'required|string|min:1|max:13',
            'alamat' => 'required|string|min:1|max:60',
            'wilayah_kerjas_id' => 'required',
            'id_telegram' => 'nullable|string|min:0|max:40', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
