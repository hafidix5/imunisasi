<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Jenis_Imunisasi;
use App\Models\Pesans;
use App\Models\User;
use App\Models\jadwal_imunisasi;
use Illuminate\Http\Request;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use auth;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Illuminate\Support\Facades\DB;
use str;

class JadwalImunisasisController extends Controller
{
    /**
     * Display a listing of the jadwal imunisasis.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jadwalImunisasis = jadwal_imunisasi::with('jenisimunisasi', 'anak', 'pesan', 'user')->paginate(25);

        return view('jadwal_imunisasis.index', compact('jadwalImunisasis'));
    }

    /**
     * Show the form for creating a new jadwal imunisasi.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $JenisImunisasis = Jenis_Imunisasi::pluck('nama', 'id')->all();
        $Anaks = Anak::pluck('nama', 'id')->all();
        $Pesans = Pesans::pluck('jenis', 'id')->all();
        $Users = User::pluck('name', 'id')->all();
        $todayDate = Carbon::now()->format('Y-m-d');
        $hide = 'readonly';

        return view('jadwal_imunisasis.create', compact('JenisImunisasis', 'Anaks', 'Pesans', 'Users', 'todayDate', 'hide'));
    }

    /**
     * Store a new jadwal imunisasi in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */

    public function send($id)
    {
        $telegram = new Api('5619949340:AAHNn3zZ0qV0nUZFgc7-vQbFsMLizm7j0O8');
        $data=DB::select('SELECT p.pesan, i.nama AS ibu,i.id_telegram,a.nama AS anak,jj.nama,ji.tanggal,ji.tempat FROM jadwal_imunisasis AS ji JOIN anaks AS a ON ji.anaks_id=a.id JOIN ibus AS i ON a.ibus_id=i.id JOIN pesans AS p ON ji.pesans_id=p.id
        JOIN jenis_imunisasis AS jj ON ji.jenis_imunisasis_id=jj.id WHERE ji.id=?',[$id]);
        
       
        $text = str_replace(["[nama ibu]","[tanggal imunisasi]","[nama anak]","[jenis imunisasi]","[tempat imunisasi]"], [$data[0]->ibu,$data[0]->tanggal,$data[0]->anak,$data[0]->nama,$data[0]->tempat],$data[0]->pesan);

        $response = $telegram->sendMessage([
            'chat_id' => $data[0]->id_telegram,
            'text' => $text ,
        ]);
    }
    public function store(Request $request)
    {
        $cekdata=DB::select('SELECT count(*) as jumlah from jadwal_imunisasis where jenis_imunisasis_id=? and anaks_id=?', [$request->jenis_imunisasis_id,$request->anaks_id]);
        
        if($cekdata[0]->jumlah>0)
        {
            return back()
                ->withInput()
                ->withErrors(['Data sudah ada']);
        }
        $id = IdGenerator::generate(['table' => 'jadwal_imunisasis', 'length' => 7, 'prefix' => 'jd-']);
        try {
            $data = $this->getData($request);
            $data['id'] = $id;
            $data['users_id'] = auth::id();
            
            jadwal_imunisasi::create($data);
            $this->send($id);
            return redirect()
                ->route('jadwal_imunisasis.jadwal_imunisasi.index')
                ->with('success_message', 'Jadwal Imunisasi was successfully added.');
        } catch (Exception $exception) {
            return back()
                ->withInput()
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
        $jadwalImunisasi = jadwal_imunisasi::with('jenisimunisasi', 'anak', 'pesan', 'user')->findOrFail($id);

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
        $todayDate = Carbon::now()->format('Y-m-d');
        $JenisImunisasis = Jenis_Imunisasi::pluck('nama', 'id')->all();
        if ($jadwalImunisasi->tanggal >= $todayDate) {
            $hide = '';
        }
        $Anaks = Anak::pluck('nama', 'id')->all();
        $Pesans = Pesans::pluck('jenis', 'id')->all();
        $Users = User::pluck('name', 'id')->all();

        return view('jadwal_imunisasis.edit', compact('jadwalImunisasi', 'JenisImunisasis', 'Anaks', 'Pesans', 'Users', 'todayDate', 'hide'));
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

            return redirect()
                ->route('jadwal_imunisasis.jadwal_imunisasi.index')
                ->with('success_message', 'Jadwal Imunisasi was successfully updated.');
        } catch (Exception $exception) {
            return back()
                ->withInput()
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

            return redirect()
                ->route('jadwal_imunisasis.jadwal_imunisasi.index')
                ->with('success_message', 'Jadwal Imunisasi was successfully deleted.');
        } catch (Exception $exception) {
            return back()
                ->withInput()
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
            'anaks_id' => 'required',
            'tempat' => 'required|string|min:1|max:50',
            'tanggal' => 'required',
            'waktu_pemberian' => 'nullable',
            'berat_badan' => 'nullable',
            'panjang_badan' => 'nullable',
            'suhu' => 'nullable',
            'status' => 'nullable|string|min:0|max:30',
            'keterangan' => 'nullable|string|min:0|max:50',
            'pesans_id' => 'nullable',
            'status_pesan' => 'nullable|string|min:0|max:1',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
