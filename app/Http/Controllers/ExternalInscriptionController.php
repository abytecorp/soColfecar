<?php

namespace soColfecar\Http\Controllers;
use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateCompanyRequest;
use soColfecar\Http\Requests\UpdateCompanyRequest;
use soColfecar\Http\Requests\UpdateAssistantRequest;
use soColfecar\Http\Requests\CreateAssistantFastRequest;
use soColfecar\Event;
use soColfecar\Company;
use soColfecar\Assistant;
use soColfecar\Plan;
use soColfecar\Hotel;
use soColfecar\Hotel_to_event;
use soColfecar\Single_room;
use soColfecar\Double_room;
use soColfecar\Id_type;
use soColfecar\Record;
use DB;

class ExternalInscriptionController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $event['invitation_type'] = 'assistants';
        return view('external-inscriptions.create', compact('event'));
    }
    public function createSpecialGuests(Event $event)
    {
        $event['invitation_type'] = 'special-guests';
        return view('external-inscriptions.create', compact('event'));
    }
    public function createSponsors(Event $event)
    {
        $event['invitation_type'] = 'sponsors';
        return view('external-inscriptions.create', compact('event'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function getCompaniesExternal()
    {
        $companies = Company::select(DB::raw('CONCAT(IFNULL(companies.bs_name,"")," ",IFNULL(companies.acronym,"")," ( ",IFNULL(companies.nit,"")," ) ") AS label'),'companies.id AS company_id','companies.bs_name','companies.acronym','companies.nit','companies.verification_digit',
        'companies.id_company_type','companies.web','companies.email','companies.address','companies.logo','companies.phone1',
        'companies.phone2','companies.phone3','companies.id_cmp_state','companies.id_status','companies.id_city','cities.city',
        'cities.id AS city_id', 'company_states.company_state')
        ->join('cities','companies.id_city','cities.id')
        ->join('company_states','companies.id_cmp_state', 'company_states.id')
        ->get();
        return $companies;
    }
    public function getCompanyById(Company $company)
    {
        return $company;
    }
    public function companyStore(CreateCompanyRequest $request)
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
            $request['id_cmp_state'] = 16;
            $request['us_cr'] = 28;
        $company = Company::create($request->all());
        
        return $company;
    }
    public function getAssistantByCompany($company)
    {
        $assistants = Assistant::where('id_company',$company)->get();
        return $assistants;
    }
    public function assistantExternal(CreateAssistantFastRequest $request)
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
            'us_cr' => 28,
        ]);
        return;
    }
    public function getAssistantById($assistant)
    {   
        $assistants = Assistant::select('assistants.id', 'assistants.names', 'assistants.last_names', 'assistants.id_type', 
            'assistants.id_number', 'assistants.id_city', 'assistants.address', 'assistants.tel', 'assistants.cel', 
            'assistants.position', 'assistants.email', 'assistants.id_company', 'assistants.id_status', 'assistants.created_at',
            'cities.id AS city_id','cities.city')
            ->where('assistants.id',$assistant)
            ->join('cities','assistants.id_city','cities.id')
            ->first();
        return $assistants;
    }
    public function getPlansExternal($invitation_type,$event_id)
    {
        $events = Plan::where('invitation_type','=',$invitation_type)
                    ->where('id_event','=',$event_id)
                    ->where('id_status',1)
                    ->get();
        return $events;
    }
    public function getHotelsExternal($event)
    {
        $hotels = Hotel_to_event::select('hotel_to_events.id','hotel_to_events.event_id','hotel_to_events.single_rooms','hotel_to_events.double_rooms',
            'hotels.id AS hotel_id','hotels.hotel_name','hotels.id_city','hotels.address')
            ->where('hotel_to_events.event_id',$event)
            ->where('status_id',1)
            ->join('hotels','hotel_to_events.hotel_id','hotels.id')
            ->get();
        return $hotels;
    }
    public function getSingleRoomsExternal($hotel_to_event_id)
    {
        $single_rooms = Single_room::where('hotel_to_event_id',$hotel_to_event_id)->get();
        return $single_rooms;
    }
    public function getDoubleRoomsExternal($hotel_to_event_id)
    {
        $double_rooms = Double_room::where('hotel_to_event_id',$hotel_to_event_id)->get();
        return $double_rooms;
    }
    public function updateAssistantExternal(UpdateAssistantRequest $request,$assistant)
    {
        $assistant = Assistant::where('id',$assistant)->first();
        $assistant->update(
            $request->all()
        );
        return;
    }
    public function getIdTypesExternal()
    {
        $id_types = Id_type::get();
        return $id_types;
    }
    public function storeRecordExternal(Request $request)
    {
        $record = Record::create($request->all());
        return $record;
    }
    public function updateSingleRoom(Request $request, $single_room_id)
    {
        $single_room = Single_room::find($single_room_id)->update($request->all());
        return;
    }
    public function updateDoubleRoom(Request $request, $double_room_id)
    {
        $double_room = Double_room::find($double_room_id)->update($request->all());
        return;
    }
    public function getSuscriptedAssistant($assistant,$event)
    {
        $record = Record::where('id_assistant','=',$assistant)
            ->where('id_event','=',$event)
            ->first();
        return $record;
    }
}