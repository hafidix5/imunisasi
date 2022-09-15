<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\anak;
use App\Models\jenis_imunisasi;
use App\Models\pesans;
use App\Models\user;
use App\Models\jadwal_imunisasi;
use Illuminate\Http\Request;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Illuminate\Support\Facades\DB;
use Str;

class JadwalImunisasisController extends Controller
{
    /**
     * Display a listing of the jadwal imunisasis.
     *
     * @return Illuminate\View\View
     */

    function __construct()
    {
        $this->middleware('permission:jadwalimunisasis-list|jadwalimunisasis-create|jadwalimunisasis-edit|jadwalimunisasis-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:jadwalimunisasis-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jadwalimunisasis-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jadwalimunisasis-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $cek_roles = DB::select('SELECT r.name FROM users AS u JOIN roles AS r ON u.id=r.id WHERE u.id=?', [auth::id()]);
        $roles = $cek_roles[0]->name;
        if ($cek_roles[0]->name == 'Admin') {
            $jadwalImunisasis = jadwal_imunisasi::with('jenisimunisasi', 'anak', 'pesan', 'user')->paginate(25);
        } else {
            $jadwalImunisasis = DB::table('users as u')
                ->join('jadwal_imunisasis as ji', 'ji.users_id', '=', 'u.id')
                ->join('anaks as an', 'ji.anaks_id', '=', 'an.id')
                ->join('jenis_imunisasis AS jim', 'ji.jenis_imunisasis_id', '=', 'jim.id')
                ->join('pesans AS p', 'ji.pesans_id', '=', 'p.id')
                ->select('jim.nama AS jenis', 'an.nama AS anak', 'ji.id', 'ji.tempat', 'ji.tanggal', 'ji.waktu_pemberian', 'ji.berat_badan', 'ji.panjang_badan', 'ji.status', 'ji.suhu', 'ji.status_pesan')
                ->where('u.id', auth::id())
                ->paginate(25);
            /*  dd($jadwalImunisasis);
            $jadwalImunisasis=DB::select('SELECT jim.nama AS jenis, an.nama AS anak,ji.id, ji.tempat, ji.tanggal,
            ji.waktu_pemberian,ji.berat_badan,ji.panjang_badan,ji.status,ji.suhu,ji.status_pesan FROM users AS u
            JOIN jadwal_imunisasis AS ji ON u.id=ji.users_id
            JOIN anaks AS an ON ji.anaks_id=an.id JOIN jenis_imunisasis AS jim on ji.jenis_imunisasis_id=jim.id
            JOIN pesans AS p ON ji.pesans_id=p.id '); */
        }

        //$jadwalImunisasis = jadwal_imunisasi::with('jenisimunisasi', 'anak', 'pesan', 'user')->paginate(25);

        return view('jadwal_imunisasis.index', compact('jadwalImunisasis', 'roles'));
    }

    /**
     * Show the form for creating a new jadwal imunisasi.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $JenisImunisasis = jenis_jmunisasi::pluck('nama', 'id')->all();
        $Anaks = anak::pluck('nama', 'id')->all();
        $Pesans = pesans::pluck('jenis', 'id')->all();
        $Users = user::pluck('name', 'id')->all();
        $todayDate = Carbon::now()->format('Y-m-d');
        $hide = 'readonly';
        $hide2 = '';

        return view('jadwal_imunisasis.create', compact('JenisImunisasis', 'Anaks', 'Pesans', 'Users', 'todayDate', 'hide','hide2'));
    }

    /**
     * Store a new jadwal imunisasi in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function send2($id)
    {
        $telegram = new Api('5619949340:AAHNn3zZ0qV0nUZFgc7-vQbFsMLizm7j0O8');
        $data = DB::select(
            'SELECT p.pesan, i.nama AS ibu,i.id_telegram,a.nama AS anak,jj.nama,ji.tanggal,ji.tempat FROM jadwal_imunisasis AS ji JOIN anaks AS a ON ji.anaks_id=a.id JOIN ibus AS i ON a.ibus_id=i.id JOIN pesans AS p ON ji.pesans_id=p.id
        JOIN jenis_imunisasis AS jj ON ji.jenis_imunisasis_id=jj.id WHERE ji.id=?',
            [$id],
        );

        $text = str_replace(['[nama ibu]', '[tanggal imunisasi]', '[nama anak]', '[jenis imunisasi]', '[tempat imunisasi]'], [$data[0]->ibu, $data[0]->tanggal, $data[0]->anak, $data[0]->nama, $data[0]->tempat], $data[0]->pesan);
        $text = 'Mengingatkan Kembali ' . $text;
        $response = $telegram->sendMessage([
            'chat_id' => $data[0]->id_telegram,
            'text' => $text,
        ]);
    }

    public function send($id)
    {
        $telegram = new Api('5619949340:AAHNn3zZ0qV0nUZFgc7-vQbFsMLizm7j0O8');
        $data = DB::select(
            'SELECT p.pesan, i.nama AS ibu,i.id_telegram,a.nama AS anak,jj.nama,ji.tanggal,ji.tempat FROM jadwal_imunisasis AS ji JOIN anaks AS a ON ji.anaks_id=a.id JOIN ibus AS i ON a.ibus_id=i.id JOIN pesans AS p ON ji.pesans_id=p.id
        JOIN jenis_imunisasis AS jj ON ji.jenis_imunisasis_id=jj.id WHERE ji.id=?',
            [$id],
        );

        $text = str_replace(['[nama ibu]', '[tanggal imunisasi]', '[nama anak]', '[jenis imunisasi]', '[tempat imunisasi]'], [$data[0]->ibu, $data[0]->tanggal, $data[0]->anak, $data[0]->nama, $data[0]->tempat], $data[0]->pesan);

        $response = $telegram->sendMessage([
            'chat_id' => $data[0]->id_telegram,
            'text' => $text,
        ]);
    }
    public function store(Request $request)
    {
        $cekdata = DB::select('SELECT count(*) as jumlah from jadwal_imunisasis where jenis_imunisasis_id=? and anaks_id=?', [$request->jenis_imunisasis_id, $request->anaks_id]);

        if ($cekdata[0]->jumlah > 0) {
            return back()
                ->withInput()
                ->withErrors(['Data sudah ada']);
        }
        $id = IdGenerator::generate(['table' => 'jadwal_imunisasis', 'length' => 7, 'prefix' => 'jd-']);
        try {
            $data = $this->getData($request);
            $data['id'] = $id;
            $data['users_id'] = auth::id();
            $data['status_pesan'] = 0;
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

    public function sync()
    {
        $total = 0;
        $todayDate = Carbon::now()->format('Y-m-d');
        
        $yesterday = Carbon::yesterday()->format('Y-m-d');
       
        
        $datas = DB::select(
            'SELECT p.pesan, i.nama AS ibu,i.id_telegram,a.nama AS anak,jj.nama,ji.tanggal,ji.tempat,ji.status_pesan,ji.id FROM jadwal_imunisasis AS ji JOIN anaks AS a ON ji.anaks_id=a.id JOIN ibus AS i ON a.ibus_id=i.id JOIN pesans AS p ON ji.pesans_id=p.id
        JOIN jenis_imunisasis AS jj ON ji.jenis_imunisasis_id=jj.id WHERE ji.status_pesan=? AND ? = DATE_SUB(ji.tanggal, INTERVAL 1 day)',
            ['0', $todayDate],
        );
        
        foreach ($datas as $data) {
            $this->send2($data->id);
            DB::table('jadwal_imunisasis')
                ->where('id', $data->id)
                ->update([
                    'status_pesan' => 1,
                ]);
            $total++;
        }

        return redirect()
            ->route('riwayat_pesans.riwayat_pesans.index')
            ->with('success_message', 'Pesan telegram terkirim sebanyak: ' . $total);
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
        $JenisImunisasis = jenis_imunisasi::pluck('nama', 'id')->all();
        if ($todayDate >= $jadwalImunisasi->tanggal) {
            $hide = '';
            $hide2 = 'readonly';
        } else {
            $hide = 'readonly';
            $hide2 = '';
        }
        $Anaks = anak::pluck('nama', 'id')->all();
        $Pesans = pesans::pluck('jenis', 'id')->all();
        $Users = user::pluck('name', 'id')->all();

        return view('jadwal_imunisasis.edit', compact('jadwalImunisasi', 'JenisImunisasis', 'Anaks', 'Pesans', 'Users', 'todayDate', 'hide','hide2'));
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
        $todayDate = Carbon::now()->format('Y-m-d');
        $formatted_dt1 = Carbon::parse($todayDate);
        $date = $request->waktu_pemberian;
        $formatted_dt2 = Carbon::parse($date);
        $diff = $formatted_dt1->diffInMonths($formatted_dt2);

        $cek_status = DB::table('jadwal_imunisasis as ji')
            ->join('jenis_imunisasis as jj', 'ji.jenis_imunisasis_id', '=', 'jj.id')
            ->select('jj.waktu_tepat', 'jj.waktu_telat')
            ->where('ji.jenis_imunisasis_id', $request->jenis_imunisasis_id)
            ->first();
       

        try {
            $data = $this->getData($request);
            if (($diff <= $cek_status->waktu_tepat)&&($diff < $cek_status->waktu_telat)) {
                $data['status']='Tepat Waktu';
            } else {
                if($diff >= $cek_status->waktu_telat)
                {
                    $data['status']='Terlambat';
                }
            }
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
            'jenis_imunisasis_id' => 'nullable',
            'anaks_id' => 'nullable',
            'tempat' => 'nullable|string|min:1|max:50',
            'tanggal' => 'nullable',
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
