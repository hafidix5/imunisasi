<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\user;
use App\Models\users_wilayahs;
use App\Models\wilayah_kerjas;
use Illuminate\Http\Request;
use Exception;

class UsersWilayahsController extends Controller
{

    /**
     * Display a listing of the users wilayahs.
     *
     * @return Illuminate\View\View
     */
    function __construct()
    {
         $this->middleware('permission:userswilayahs-list|userswilayahs-create|userswilayahs-edit|userswilayahs-delete', ['only' => ['index','store']]);
         $this->middleware('permission:userswilayahs-create', ['only' => ['create','store']]);
         $this->middleware('permission:userswilayahs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:userswilayahs-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $usersWilayahsObjects = users_wilayahs::with('user','WilayahKerja')->paginate(25);

        return view('users_wilayahs.index', compact('usersWilayahsObjects'));
    }

    /**
     * Show the form for creating a new users wilayahs.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Users = user::pluck('name','id')->all();
        $wilayah_kerjas = wilayah_kerjas::pluck('nama','id')->all();
        
        return view('users_wilayahs.create', compact('Users','wilayah_kerjas'));
    }

    /**
     * Store a new users wilayahs in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            //dd($data);
            users_wilayahs::create($data);

            return redirect()->route('users_wilayahs.users_wilayahs.index')
                ->with('success_message', 'Users Wilayahs was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified users wilayahs.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $usersWilayahs = users_wilayahs::with('user')->findOrFail($id);

        return view('users_wilayahs.show', compact('usersWilayahs'));
    }

    /**
     * Show the form for editing the specified users wilayahs.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $usersWilayahs = users_wilayahs::findOrFail($id);
        $Users = user::pluck('name','id')->all();
        $wilayah_kerjas = wilayah_kerjas::pluck('nama','id')->all();

        return view('users_wilayahs.edit', compact('usersWilayahs','Users','wilayah_kerjas'));
    }

    /**
     * Update the specified users wilayahs in the storage.
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
            
            $usersWilayahs = users_wilayahs::findOrFail($id);
            $usersWilayahs->update($data);

            return redirect()->route('users_wilayahs.users_wilayahs.index')
                ->with('success_message', 'Users Wilayahs was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified users wilayahs from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $usersWilayahs = users_wilayahs::findOrFail($id);
            $usersWilayahs->delete();

            return redirect()->route('users_wilayahs.users_wilayahs.index')
                ->with('success_message', 'Users Wilayahs was successfully deleted.');
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
                'users_id' => 'required', 
                'wilayah_kerjas_id'=>'required',
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
