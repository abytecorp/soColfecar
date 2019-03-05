<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateCompanyRequest;
use Caffeinated\Shinobi\Models\Role;
use soColfecar\Company_state;
use soColfecar\Company_type;
use soColfecar\Change;
use soColfecar\Company;
use soColfecar\Event_type;
use Auth;

class AffiliationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_states = Company_state::all();
        $companies = Company::all();
        $changes = Change::orderBy('created_at','DESC')->paginate(6);
        $title= 'Afiliaciones';
        return view('affiliations.index',compact('company_states','title','changes','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_types = Company_type::pluck('company_type', 'id');
        $title = 'Nueva Afiliacion';
        return view('affiliations.create', compact('title', 'company_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $title = 'Empresas ';
        $logo = $request->file('logo');
        $company =Company::create([
            'bs_name' => $request['bs_name'],
            'acronym' => $request['acronym'],
            'nit' => $request['nit'],
            'id_company_type' => $request['id_company_type'],
            'web' => $request['web'],
            'email' => $request['email'],
            'logo' => $logo->store('logos','public'),
            'id_cmp_state' => 1,
            'us_cr' => Auth::user()->id
        ]);
        Change::create([
            'description' => 'Creo la empresa:'.$request['bs_name'].'   correctamente.',
            'id_item' => 7,
            'id_user' => Auth::user()->id,
        ]);
        return view('affiliations.tasks', compact('title','company'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $title = $company->bs_name;
        return view('affiliations.show', compact('company', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function obestados(Request $request)
    {
        $company_states = Company_state::all();
        //dd($company_states);
        return $company_states;
    }
    public function getChanges(Request $request, $module)
    {
        $changes = Change::with('user')
        ->where('id_item', $module)
        ->orderBy('created_at', 'DESC')
        ->paginate(6);
        return [
            'paginate' => [
                'total' => $changes->total(),
                'total' => $changes->currentPage(),
                'total' => $changes->perPage(),
                'total' => $changes->lastPage(),
                'total' => $changes->firstItem(),
                'total' => $changes->lastItem(),
            ],
            'changes' => $changes
        ];
    }
    public function getCompanies(Request $request, $id_cmp_state)
    {
        $companies = Company::where('id_cmp_state', $id_cmp_state)
        ->get();
        //dd($companies);
        return response()->json($companies);
    }
}
