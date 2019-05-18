<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateCompanyRequest;
use soColfecar\Http\Requests\UpdateCompanyRequest;
use soColfecar\Http\Requests\CreateCompanyStateRequest;
use soColfecar\Http\Requests\UpdateCompanyStateRequest;
use soColfecar\Http\Requests\CreateCompanyTypeRequest;
use soColfecar\Http\Requests\UpdateCompanyTypeRequest;
use Caffeinated\Shinobi\Models\Role;
use soColfecar\Company_state;
use soColfecar\Company_type;
use soColfecar\Change;
use soColfecar\Company;
use soColfecar\Event_type;
use soColfecar\Item;
use soColfecar\Icon;
use soColfecar\Assistant;
use soColfecar\Event;
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
        $item_id= Item::where('item',$title)->first();
        return view('affiliations.index',compact('company_states','title','changes','companies','item_id'));
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
        if($request['logoChanged']){
            $exploded = explode(',', $request->logo);
                    $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';
            $fileName = str_random().'.'.$extension;
            $path = public_path().'/storage/logos/'.$fileName;
            file_put_contents($path, $decoded);
            $logo = $request->file['logo'];
            $request['logo'] = $fileName;
            }else{
                $request['logo'] = '';
            }
            $request['bs_name'] = strtoupper($request['bs_name']);
            $request['acronym'] = strtoupper($request['acronym']);
            $request['id_status'] = 1;
            $request['us_cr'] = Auth::user()->id;
        $company = Company::create($request->all());
        Change::create([
            'description' => 'Ha creado la empresa: ['.$request['bs_name'].'] correctamente.',
            'id_item' => 7,
            'id_user' => Auth::user()->id,
        ]);
        return;
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
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::where('id',$id)->first();
        if($request['logoChanged']){
            $exploded = explode(',', $request->logo);
                    $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';
            $fileName = str_random().'.'.$extension;
            $path = public_path().'/storage/logos/'.$fileName;
            file_put_contents($path, $decoded);
            $logo = $request->file['logo'];
            $request['logo'] = $fileName;
            }else{
                $request['logo'] = '';
            }
            $request['bs_name'] = strtoupper($request['bs_name']);
            $request['acronym'] = strtoupper($request['acronym']);
            $company->update(
                $request->all()
            );
            Change::create([
                'description' => 'Actualizo datos la empresa :'.$request['bs_name'].' correctamente.',
                'id_user' => Auth::user()->id,
                'id_item' => 7
            ]);
            return;
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
        $company_states = Company_state::where('id_status',1)->get();
        //dd($company_states);
        return $company_states;
    }
    public function getAllStates(Request $request)
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
    public function getCompaniesApi()
    {
        $companies = Company::select('companies.id AS company_id','companies.bs_name','companies.acronym','companies.nit','companies.verification_digit',
        'companies.id_company_type','companies.web','companies.email','companies.address','companies.logo','companies.phone1',
        'companies.phone2','companies.phone3','companies.id_cmp_state','companies.id_status','companies.id_city','cities.city',
        'cities.id AS city_id', 'company_states.company_state')
        ->join('cities','companies.id_city','cities.id')
        ->join('company_states','companies.id_cmp_state', 'company_states.id')
        ->get();
        return $companies;
    }
    public function getCompaniesByState($request)
    {
        $companies = Company::where('id_cmp_state',$request)
            ->get();
        return $companies;
    }
    public function getCompanyById($request)
    {
        $company = Company::select('companies.id AS company_id','companies.bs_name','companies.acronym','companies.nit','companies.verification_digit',
            'companies.id_company_type','companies.web','companies.email','companies.address','companies.logo','companies.phone1',
            'companies.phone2','companies.phone3','companies.id_cmp_state','companies.id_status','companies.id_city','cities.city',
            'cities.id AS city_id')
            ->where('companies.id',$request)
            ->join('cities','companies.id_city','cities.id')
            ->first();
        return $company;
    }
    public function setCompanyStateStatus($setvalue,$id)
    {
        $company_state = Company_state::where('id',$id)->first();
        $company_state['id_status'] = $setvalue;
        $company_state->update();
        if($setvalue == 1){
        Change::create([
            'description' => 'Activo el estado :'.$company_state['company_state'],
            'id_user' => Auth::user()->id,
            'id_item' => 7
        ]);
        }else{
            Change::create([
                'description' => 'Desactivo el estado :'.$company_state['company_state'],
                'id_user' => Auth::user()->id,
                'id_item' => 7
            ]);
        }
        return;
    }
    public function getIcons()
    {
        return $icons = Icon::all();
    }
    public function storeCompanyState(CreateCompanyStateRequest $request)
    {
        $company_state = Company_state::create($request->all());
        Change::create([
            'description' => 'Creo el estado de empresa: ['.$request['company_state'].'].',
            'id_item' => 7,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function getCompanyState($request)
    {
        $company_state = Company_state::where('id',$request)->first();
        return $company_state;
    }
    public function stateUpdate(UpdateCompanyStateRequest $request)
    {
        $company_state = Company_state::where('id',$request['id'])->first();
        $company_state->update(
            $request->all()
        );
        Change::create([
            'description' => 'Edito el estado de empresa: ['.$request['company_state'].'].',
            'id_item' => 7,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }

    //manage type options
    public function storeCompanyType(CreateCompanyTypeRequest $request)
    {
        $company_type = Company_type::create($request->all());
        Change::create([
            'description' => 'Creo el tipo de empresa: ['.$request['company_type'].'].',
            'id_item' => 7,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function getCompanyType($request)
    {
        $company_type = Company_type::where('id',$request)->first();
        return $company_type;
    }
    public function typeUpdate(UpdateCompanyTypeRequest $request)
    {
        $company_type = Company_type::where('id',$request['id'])->first();
        $company_type->update(
            $request->all()
        );
        Change::create([
            'description' => 'Edito el tipo de empresa: ['.$request['company_type'].'].',
            'id_item' => 7,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function setCompanyTypeStatus($setvalue,$id)
    {
        $company_type = Company_type::where('id',$id)->first();
        $company_type['id_status'] = $setvalue;
        $company_type->update();
        if($setvalue == 1){
        Change::create([
            'description' => 'Activo el estado :'.$company_type['company_type'],
            'id_user' => Auth::user()->id,
            'id_item' => 7
        ]);
        }else{
            Change::create([
                'description' => 'Desactivo el tipo de empresa :'.$company_type['company_type'],
                'id_user' => Auth::user()->id,
                'id_item' => 7
            ]);
        }
        return;
    }
    public function getAllTypes(Request $request)
    {
        $company_types = Company_type::all();
        return $company_types;
    }
    public function setAssistantStatus($setvalue,$id)
    {
        $assistant = Assistant::where('id',$id)->first();
        $assistant['id_status'] = $setvalue;
        $assistant->update();
        if($setvalue == 1){
        Change::create([
            'description' => 'Activo el asistente con id  ['.$assistant['id'].']',
            'id_user' => Auth::user()->id,
            'id_item' => 7
        ]);
        }else{
            Change::create([
                'description' => 'Inhabilito el asistente con id  ['.$assistant['id'].']',
                'id_user' => Auth::user()->id,
                'id_item' => 7
            ]);
        }
        return;
    }
    public function getEventsByType($request)
    {
        $events = Event::where('id_event_type',$request)
            ->get();
        return $events;
    }
}
