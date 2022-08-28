<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\users_wilayahs;
use Illuminate\Http\Request;
use Exception;

class UsersWilayahsController extends Controller
{

    /**
     * Display a listing of the users wilayahs.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $usersWilayahsObjects = users_wilayahs::with('user')->paginate(25);

        return view('users_wilayahs.index', compact('usersWilayahsObjects'));
    }

    /**
     * Show the form for creating a new users wilayahs.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Users = User::pluck('name','id')->all();
        
        return view('users_wilayahs.create', compact('Users'));
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
        $Users = User::pluck('name','id')->all();

        return view('users_wilayahs.edit', compact('usersWilayahs','Users'));
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
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
