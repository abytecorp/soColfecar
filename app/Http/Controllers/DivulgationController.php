<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\UpdateAssistantRequest;
use soColfecar\Event;
use soColfecar\Plan;
use soColfecar\Company;
use soColfecar\Assistant;
use soColfecar\Company_state;
use soColfecar\City;
use soColfecar\Hotel;
use soColfecar\Room_type;
use soColfecar\Room;
use soColfecar\Rooms_to_hotel;
use soColfecar\Record;
use soColfecar\Academic_agenda;
use soColfecar\Breakfast;
use soColfecar\Lunch;
use soColfecar\Refreshment;
use soColfecar\Dinner;
use soColfecar\Bill;
use soColfecar\User_type;
use soColfecar\Id_type;
use soColfecar\Change;
use soColfecar\Reg_observation;
use soColfecar\Billing_debit;
use soColfecar\Billing_cost;
use Auth;
use DB;



class DivulgationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $events = Event::select('events.id','events.event','events.id_event_type','events.date_init','events.date_end',
        'events.banner','events.id_status','events.created_at','events.updated_at','event_types.event_type')
            ->where('events.id_status',1)
            ->join('event_types', 'event_types.id','=','events.id_event_type')
            ->get();
        $title = 'Seleccione un evento porfavor';
        return view('divulgations.index', compact('title','events'));
    }

    public function eventDetail(Event $event)
    {
      $plans = Plan::where('id_event',$event->id)->get();
        //dd($events);
        $title = $event->event;
        return view('divulgations.event-index', compact('title','event','plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function getPlansEvent(Event $event)
    {
        
        $plans = Plan::where('id_event',$event->id)
            ->where('id_status','=',1)
            ->get();
        //dd($plans);
        return $plans;
    }
    public function getCompanies()
    {
        $companies = Company::where('id_status',1)->get();
        return $companies;
    }
    public function getAssistantsByCompany($company)
    {
        $assistants = Assistant::select(DB::raw('CONCAT(IFNULL(assistants.names,"")," ",IFNULL(assistants.last_names,"")) AS full_name'),'assistants.id','assistants.names','assistants.last_names','assistants.id_type','assistants.id_number','assistants.id_city','assistants.address',
            'assistants.tel','assistants.cel','assistants.position','assistants.email','assistants.id_company','assistants.id_status','status.status')
            ->where('assistants.id_company',$company)
            //->where('assistants.id_status',1)
            ->join('status', 'assistants.id_status','=','status.id')
            ->get();
        return $assistants;
    }
    public function getPlans($event)
    {
        $plans = Plan::select('plans.id','plans.plan','plans.pl_desc','plans.id_event','plans.price',
                            'plans.id_status','plans.id_company_state','plans.academic_agenda','plans.lunches','plans.refreshments',
                            'plans.dinner','plans.breakfast','plans.host','company_states.id AS id_cps', 'company_states.company_state')
            ->where('id_event','=',$event)
            ->join('company_states','plans.id_company_state','company_states.id')
            ->get();
        return $plans;
    }
    public function getCompanyStates()
    {
        $company_states = Company_state::where('id_status',1)
            ->orWhere('id',4)
            ->get();
        return $company_states;
    }
    public function getEvents(Event $event)
    {
        return $event;
    }
    public function getCities()
    {
        return $city = City::select(DB::raw('CONCAT(cities.city," ( ",departaments.departament," ) ") AS city'),'cities.id','cities.id_departament','departaments.departament')
            ->join('departaments','cities.id_departament','departaments.id')
            ->get();
    }
    public function getHotels()
    {
        return $hotels = Hotel::with('rooms')->get();
    }
    public function getRoomTypes()
    {
        return $room_types = Room_type::get();
    }
    public function getRoomsByHotel($id_hotel)
    {
        return $rooms = Room::with('room_types')
            ->with('rooms_to_hotels')
            ->where('id_hotel',$id_hotel)
            ->get();
    }
    public function getAssistantRecord($assistant,$event)
    {
        $assistant = Record::where('id_assistant',$assistant)
                    ->where('id_event',$event)
                    ->first();
        return compact('assistant');
    }
    public function getAssistantByEvent($event)
    {
        $assistants = Record::select(DB::raw('CONCAT(IFNULL(assistants.names,"")," ",IFNULL(assistants.last_names,"")) AS full_name'),'records.id As record_id', 'records.id_assistant','assistants.id','assistants.names','assistants.last_names','assistants.position','assistants.email',
                                        'assistants.id_company','companies.bs_name','companies.acronym')
                                    ->where('id_event',$event)
                                    ->join('assistants','records.id_assistant','assistants.id')
                                    ->join('companies','assistants.id_company','companies.id')
                                    ->get();
        return $assistants;
    }
    public function setEntryInRecord($assistant,$event)
    {
        $record = Record::where('id_assistant',$assistant)
                        ->where('id_event',$event)
                        ->first();
        if($record) {
            $record->entry_moment = now();
            $record->save();
        }
        return;
    }
    public function getAssistantsRegistered($event)
    {
        $assistants_reg = Record::select('records.id AS record_id','records.id_assistant','records.id_plan','records.id_record_state','records.created_at',
            'records.updated_at','records.id_record_state','records.enroll_name','records.enroll_email','records.printed_at','records.printed_by',
            'records.id_status_gafete','records.entry_moment','assistants.names','assistants.last_names')
                                ->where('id_event',$event)
                                ->where('entry_moment','!=',null)
                                ->join('assistants','records.id_assistant','assistants.id')
                                ->get();
        return $assistants_reg;
    }
    public function getRefStatusRecord($user,$ref_mode)
    {
        $recordS = Record::where('id_assistant',$user)->first(); 
        return $recordS;
    }
    public function getRegByAssId($id_assistant,$event)
    {
        $record = Record::select('records.id AS record_id','records.id_assistant','records.id_plan','records.id_record_state','records.created_at',
        'records.updated_at','records.id_record_state','records.enroll_name','records.enroll_email','records.printed_at','records.printed_by',
        'records.id_status_gafete','records.entry_moment','records.Refrigeriodia1','records.Refrigeriodia2','records.Refrigeriodia3','records.Refrigeriodia4',
        'records.Almuerzodia1','records.Almuerzodia2','records.Almuerzodia3','records.Cenadia1','records.Cenadia2','records.Cenadia3','assistants.names','assistants.last_names')
                ->where('id_assistant',$id_assistant)
                ->where('id_event',$event)
                ->join('assistants','records.id_assistant','assistants.id') 
                ->get();
        return $record;
    }
    public function getRegByRecId($id_record)
    {
        $record = Record::select('records.id AS record_id','records.id_assistant','records.id_plan','records.id_record_state','records.created_at',
        'records.updated_at','records.id_record_state','records.enroll_name','records.enroll_email','records.printed_at','records.printed_by',
        'records.id_status_gafete','records.entry_moment','records.Refrigeriodia1','records.Refrigeriodia2','records.Refrigeriodia3','records.Refrigeriodia4',
        'records.Almuerzodia1','records.Almuerzodia2','records.Almuerzodia3','records.Cenadia1','records.Cenadia2','records.Cenadia3','assistants.names',
        'assistants.last_names','plans.price AS plan_price')
                ->where('records.id',$id_record)
                ->join('assistants','records.id_assistant','assistants.id')
                ->join('plans','records.id_plan','plans.id')
                ->first();
        return $record;
    }
    public function setRegRef($id_ref,$ref_mode,$record)
    {
        if($ref_mode == 'AgendaAcademica'){
            $academic_agenda = Academic_agenda::where('id',$id_ref)
            ->first();
            if($academic_agenda) {
            $academic_agenda->claim = now();
            $academic_agenda->save();
            }
        }else if($ref_mode != 'AgendaAcademica'){
            $recordS = Record::where('id',$record)
            ->first();
            if($recordS) {
            $recordS->$ref_mode = 1;
            $recordS->save();
            }
       
        }
        return;
    }
    public function eventDataTable($event) 
    {
        $title = 'listado general';
        $bills = Bill::get();
        $user_types = User_type::pluck('user_type', 'id');
        $companies = Company::get();
        $id_types = Id_type::pluck('id_type','id');
        $cities = City::get();
        $plans = Plan::get();
        $refreshments = Refreshment::get();
        
        $records = Record::select(
            'records.id AS id_r','records.id_assistant','records.id_event','records.id_plan',
            'records.id_record_state','records.enroll_name','records.enroll_email','records.Refrigeriodia1','records.Refrigeriodia2','records.Refrigeriodia3','records.Refrigeriodia4',
            'records.Almuerzodia1','records.Almuerzodia2','records.Almuerzodia3','records.Cenadia1','records.Cenadia2','records.Cenadia3', 'records.printed_at', 'records.id_status_gafete',
            'assistants.names','assistants.last_names','assistants.id_type','assistants.id_number','assistants.id_city','assistants.address','assistants.tel','assistants.cel','assistants.position', 'assistants.email' ,'assistants.id_company',
            'cities.city','departaments.departament','companies.bs_name','companies.acronym', 'companies.nit', 'companies.id_cmp_state',
            'plans.plan', 'plans.price', 'plans.pl_desc', 'plans.id_event', 'record_states.record_state',
            'bills.price AS bill_price','bills.us_cr', 'bills.id AS bill_id'
            )
            ->join('assistants', 'records.id_assistant','=','assistants.id')
            ->join('cities', 'assistants.id_city','=','cities.id')
            ->join('departaments', 'cities.id_departament','=','departaments.id')
            ->join('companies', 'assistants.id_company','=','companies.id')
            ->join('plans', 'records.id_plan','=','plans.id')
            ->join('record_states', 'records.id_record_state','=','record_states.id')
            ->join('bills', 'bills.id_record','=','records.id')
            ->where('records.id_event',$event)
            ->get();
      return view('divulgations.data-table',compact('title','records','user_types','id_types','companies','cities','plans'));
    }
    public function updatePlanRecord(Request $request)
    {
        
            $record = Record::where('id',$request->id_record)
            ->first();
            if($record) {
            $record->id_plan = $request->id_plan;
            $record->save();
            }
        return back();
    }
    public function updateBillPrice(Request $request)
    {
        
            $bill = Bill::where('id',$request->bill_id)
            ->first();
            if($bill) {
            $bill->price = $request->bill_price;
            $bill->save();
            }
        return back();
    }
    public function updateRefStatus(Request $request)
    {   //dd($request);
        $record = Record::where('id',$request->id_r)
            ->first();
            if($record) {
                $record[$request->ref] = $request->status;
                $record->save();
            }
            return back();
    }
    public function delRegister($request)
    {
        $record = Record::where('id',$request)
            ->first();
       
            
            $academic_agendas = Academic_agenda::where('id_record',$record->id)->get();
            if($academic_agendas){
                foreach($academic_agendas as $Aacademic_agenda){
                    $academic_agenda =  Academic_agenda::find($Aacademic_agenda->id);
                    $academic_agenda->delete();
                }
                    
            }
            //
            $lunchs = Lunch::where('id_record',$record->id)->get();
            if($lunchs){
                foreach($lunchs as $Alunch){
                        $lunch =  Lunch::find($Alunch->id);
                        $lunch->delete();
                    }
            }
            $dinners = Dinner::where('id_record',$record->id)->get();
            if($dinners){
                foreach($dinners as $Adinner){
                        $dinner =  Dinner::find($Adinner->id);
                        $dinner->delete();
                    }
            }
            $refreshments = Refreshment::where('id_record',$record->id)->get();
            if($refreshments != ''){
                foreach($refreshments as $Arefreshment){
                        $refreshment =  Refreshment::find($Arefreshment->id);
                        $refreshment->delete();
                    }
            }
            $breakfast = Breakfast::where('id_record',$record->id)->get();
            if($breakfast){
                foreach($breakfast as $Abreakfas){
                        $breakfast =  Breakfast::find($Abreakfas->id);
                        $breakfast->delete();
                    }
            }
            $rooms_to_hotels = Rooms_to_hotel::where('id_record',$record->id)->get();
            if($rooms_to_hotels){
                foreach($rooms_to_hotels as $Arooms_to_hotel){
                        $rooms_to_hotel =  Rooms_to_hotel::find($Arooms_to_hotel->id);
                        $rooms_to_hotel->delete();
                    }
            }
            $bills = Bill::where('id_record',$record->id)->get();
            if($bills){
                foreach($bills as $Abill){
                        $bill =  Bill::find($Abill->id);
                        $bill->delete();
                    }
            }
        $record->delete();
        Change::create([
            'description' => 'Elimino Registro '.$record->id.' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function getObservationsByRec($record)
    {
        $reg_observations = Reg_observation::select('reg_observations.obs','reg_observations.us_cr', 'reg_observations.created_at', 'users.name','users.last_name')
            ->join('users','reg_observations.us_cr','users.id')
            ->where('id_record',$record)
            ->get();
        return $reg_observations;
    }
    public function getBillByRec($record){
        $bill = Bill::select('bills.price','bills.us_cr', 'bills.created_at','bills.id AS bill_id', 'users.name','users.last_name')
        ->join('users','bills.us_cr','users.id')
        ->where('id_record',$record)
        ->first();
        return $bill;
    }
    public function getDebitByRec($bill){
        $debits = Billing_debit::select('billing_debits.id_bill','billing_debits.debit', 'billing_debits.debit_price', 'billing_debits.observation', 'users.name','users.last_name')
        ->join('users','billing_debits.us_cr','users.id')
        ->where('id_bill',$bill)
        ->get();
        return $debits;
    }
    public function getPartnerData($assistant)
    {
        $assistant = Assistant::where('id',$assistant)
                        ->first();
        return $assistant;
    }
    public function getUpdateAssistant($assistant)
    {
        $assistant = Assistant::where('id',$assistant)
                        ->first();
        $assistant->city = City::select('city','id')->where('id',$assistant->id_city)->first();
        $assistant->bs_name = Company::select('bs_name','id')->where('id',$assistant->id_company)->first();
        return $assistant;
        
    }
    public function updateAssistant(UpdateAssistantRequest $request,Assistant $assistant)
    {
        $assistant->update($request->all());


        Change::create([
            'description' => 'Actualizo datos del asistente :'.$request['names'].' '.$request['last_names'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function getAssitantById($request)
    {
        $assistant = Assistant::select('assistants.id','assistants.names','assistants.last_names','assistants.id_type','assistants.id_number',
            'assistants.id_city','assistants.address', 'assistants.tel','assistants.cel','assistants.position','assistants.email','assistants.id_company',
            'assistants.id_status','cities.city', 'status.status')
            ->where('assistants.id', $request)
            ->join('cities', 'assistants.id_city','=','cities.id')
            ->join('status', 'assistants.id_status','=','status.id')
            ->first();
        return $assistant;
    }
    public function getPlansByEvent($event)
    {
        $event = Plan::where('id_event','=',$event)
            ->where('id_status','=',1)
            ->get();
        return $event;
    }
    public function storeNewBill(Request $request){
        $bill = Bill::create([
            'id_record' => $request['record_id'],
            'price' => $request['price'],
            'obs' => $request['obs'],
            'us_cr' => Auth::user()->id
        ]);
        return $bill;
    }
    public function getCosts($bill){
        $costs = Billing_cost::where('id_bill', '=', $bill)
            ->get();
        return $costs;
    }
    public function getLunchStatus($record){
        $lunchs_status = Record::select('Refrigeriodia1', 'Refrigeriodia2', 'Refrigeriodia3', 'Refrigeriodia4', 'Almuerzodia1', 'Almuerzodia2',
        'Almuerzodia3', 'Cenadia1', 'Cenadia2', 'Cenadia3')
            ->where('id','=',$record)
            ->first();
        return $lunchs_status;
    }
}