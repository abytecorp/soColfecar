<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateAssistantFastRequest;
use Caffeinated\Shinobi\Models\Role;
use soColfecar\Company_state;
use soColfecar\Company_type;
use soColfecar\Change;
use soColfecar\Company;
use soColfecar\Assistant;
use Auth;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssistantFastRequest $request)
    {
        $company = Assistant::create([
            'names' => strtoupper($request['names']),
            'last_names' => strtoupper($request['last_names']),
            'id_number' => $request['id_number'],
            'id_city' => $request['id_city'],
            'address' => $request['address'],
            'position' => $request['position'],
            'email' => $request['email'],
            'id_company' => $request['id_company'],
            'us_cr' => Auth::user()->id,
        ]);
        Change::create([
            'description' => 'Creo el contacto:'.$request['names'].' '.$request['last_names'].' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $assistant = Assistant::findOrfail($request->assistant_id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
