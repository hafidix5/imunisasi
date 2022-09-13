<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ibu;
use App\Models\anak;
use Illuminate\Http\Request;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Auth;
use Illuminate\Support\Facades\DB;

class AnaksController extends Controller
{

    /**
     * Display a listing of the anaks.
     *
     * @return Illuminate\View\View
     */
    function __construct()
    {
         $this->middleware('permission:anaks-list|anaks-create|anaks-edit|anaks-delete', ['only' => ['index','store']]);
         $this->middleware('permission:anaks-create', ['only' => ['create','store']]);
         $this->middleware('permission:anaks-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:anaks-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $cek_roles=DB::select('SELECT r.name FROM users AS u JOIN roles AS r ON u.id=r.id WHERE u.id=?',[auth::id()]);
        if($cek_roles[0]->name=='Admin')
        {
           /*  $anaks=DB::select('SELECT an.id,an.nama,an.tgl_lahir,an.jenis_kelamin,i.nama AS ibu FROM users AS u JOIN users_wilayahs AS uw ON
            u.id=uw.users_id JOIN wilayah_kerjas AS wk ON uw.wilayah_kerjas_id=wk.id
            JOIN ibus AS i ON wk.id=i.wilayah_kerjas_id
            JOIN anaks AS an ON i.id=an.ibus_id'); */
            $anaks=DB::table('users as u')->join('users_wilayahs AS uw','u.id','=','uw.users_id')
            ->join('wilayah_kerjas AS wk','uw.wilayah_kerjas_id','=','wk.id')
            ->join('ibus as i','wk.id','=','i.wilayah_kerjas_id')
            ->join('anaks as an','i.id','=','an.ibus_id')
            ->select('an.id','an.nama','an.tgl_lahir','an.jenis_kelamin','i.nama as ibu')
            ->groupBy('an.id')
            ->paginate(25);
        }
        else
        {            
            $anaks=DB::table('users as u')->join('users_wilayahs AS uw','u.id','=','uw.users_id')
            ->join('wilayah_kerjas AS wk','uw.wilayah_kerjas_id','=','wk.id')
            ->join('ibus as i','wk.id','=','i.wilayah_kerjas_id')
            ->join('anaks as an','i.id','=','an.ibus_id')
            ->select('an.id','an.nama','an.tgl_lahir','an.jenis_kelamin','i.nama as ibu')
            ->where('uw.users_id',auth::id())->paginate(25);
            /* $anaks=DB::select('SELECT an.id,an.nama,an.tgl_lahir,an.jenis_kelamin,i.nama AS ibu FROM
             users AS u JOIN users_wilayahs AS uw ON
            u.id=uw.users_id JOIN wilayah_kerjas AS wk ON uw.wilayah_kerjas_id=wk.id
            JOIN ibus AS i ON wk.id=i.wilayah_kerjas_id
            JOIN anaks AS an ON i.id=an.ibus_id WHERE uw.users_id=?',[auth::id()]); */
           
            
        }

        

        return view('anaks.index', compact('anaks'));
    }

    /**
     * Show the form for creating a new anak.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Ibus = Ibu::pluck('nama','id')->all();
        
        return view('anaks.create', compact('Ibus'));
    }

    /**
     * Store a new anak in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'anaks', 'length' => 7, 'prefix' =>'an-']);
        try {
            
            $data = $this->getData($request);
            $data['id']=$id;
            anak::create($data);

            return redirect()->route('anaks.anak.index')
                ->with('success_message', 'Anak was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified anak.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $anak = anak::with('ibu')->findOrFail($id);

        return view('anaks.show', compact('anak'));
    }

    /**
     * Show the form for editing the specified anak.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $anak = anak::findOrFail($id);
        $Ibus = Ibu::pluck('nama','id')->all();

        return view('anaks.edit', compact('anak','Ibus'));
    }

    /**
     * Update the specified anak in the storage.
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
            
            $anak = anak::findOrFail($id);
            $anak->update($data);

            return redirect()->route('anaks.anak.index')
                ->with('success_message', 'Anak was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified anak from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $anak = anak::findOrFail($id);
            $anak->delete();

            return redirect()->route('anaks.anak.index')
                ->with('success_message', 'Anak was successfully deleted.');
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
            'jenis_kelamin' => 'required|string|min:1|max:20',
            'ibus_id' => 'required', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
