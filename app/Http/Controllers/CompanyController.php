<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateCompanyFastRequest;
use Caffeinated\Shinobi\Models\Role;
use soColfecar\Company_state;
use soColfecar\Company_type;
use soColfecar\Change;
use soColfecar\Company;
use soColfecar\Event_type;
use Auth;

class CompanyController extends Controller
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
    public function store(CreateCompanyFastRequest $request)
    {
        $company = Company::create([
            'bs_name' => strtoupper($request['bs_name']),
            'acronym' => strtoupper($request['acronym']),
            'nit' => $request['nit'],
            'web' => $request['web'],
            'email' => $request['email'],
            'us_cr' => Auth::user()->id,
        ]);
        Change::create([
            'description' => 'Creo la empresa:'.$request['bs_name'].' correctamente.',
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
        //
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
