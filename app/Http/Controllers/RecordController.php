<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Record;
use soColfecar\Change;
use soColfecar\Assistant;
use soColfecar\Event;
use soColfecar\Academic_agenda;
use soColfecar\Lunch;
use soColfecar\Breakfast;
use soColfecar\Dinner;
use soColfecar\Refreshment;
use soColfecar\Bill;
use soColfecar\Rooms_to_hotel;
use soColfecar\Room;
use soColfecar\Plan;
use Auth;
use DB;

class RecordController extends Controller
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
       Record::find($id)->update([
        'printed_at' => now(),
        'printed_by' => Auth::user()->id,
        'id_status_gafete' => 1,
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
    public function getRecordsEvent($event)
    {
        
        $records = Record::select(DB::raw('CONCAT(assistants.names," ",assistants.last_names," ",companies.bs_name ) AS label'),
            'records.id AS id_r','records.id_assistant','records.id_event','records.id_plan',
            'records.id_record_state','records.enroll_name','records.enroll_email', 'records.id_partner', 'records.printed_at',
            'assistants.names','assistants.last_names',
           'companies.bs_name','companies.acronym', 'companies.nit',
            'plans.plan', 'plans.price', 'plans.pl_desc', 'plans.id_event', 'record_states.record_state',
            'bills.price AS bill_price','bills.us_cr', 'bills.id AS id_bill'
            )
            ->join('assistants', 'records.id_assistant','=','assistants.id')
            // ->join('cities', 'assistants.id_city','=','cities.id')
            // ->join('departaments', 'cities.id_departament','=','departaments.id')
            ->join('companies', 'assistants.id_company','=','companies.id')
            ->join('plans', 'records.id_plan','=','plans.id')
            ->join('record_states', 'records.id_record_state','=','record_states.id')
            ->join('bills', 'bills.id_record','=','records.id')
            ->where('records.id_event',$event)
            ->get();
            
        return $records;
    }
    public function updateRecordPrint($record)
    {
       
      $recordU = Record::where('id',  $record)
        ->update([
            'printed_at' => now(),
            'printed_by' => Auth::user()->id,
            'id_status_gafete' => 1,
        ]);
       
        Change::create([
            'description' => 'Imprimio gafete de la inscripcion'.$recordU->id.' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return $recordU;
    }

    public function printGafete(Record $record)
    {
       $id_record = $record->id;
        return view('records.print', compact('id_record'));
    }

    public function getDataAss(Record $record)
    {
        
        $assistant = Assistant::select(
            'assistants.id AS id_ass', 'assistants.names','assistants.last_names','assistants.position','assistants.email','assistants.id_company', 'assistants.tel','assistants.address','assistants.cel',
            'companies.bs_name','companies.web'
        )
        ->where('assistants.id',$record->id_assistant)
        ->join('companies','assistants.id_company','=','companies.id')
        ->get();
        return $assistant;
    }
    public function getPrinted($event)
    {
        $printed = Record::where('id_status_gafete','!=', null)->get();
        return $printed;
    }
    public function createRecord($assistant,$event,$plan,$academic_agenda,$room,$hotel,$check_in,$check_out,$price)
    {   
        $event = Event::where('id',$event)->first();
        $assistant = Assistant::where('id',$assistant)->first();
        $plan = Plan::where('id',$plan)->first();
        $record = Record::create([
            'id_assistant'  => $assistant->id,
            'id_event'      => $event->id,
            'id_plan'       => $plan->id,
            'enroll_name'   => Auth::user()->names.' '.Auth::user()->last_names,
            'enroll_email'  => $assistant->email,
            'ckeck_in'      => $check_in,
            'check_out'     => $check_out,
        ]);

        Academic_agenda::create([
            'academic_agenda'   => 'AgendaAcademica',
            'id_record'         => $record->id,
        ]);

        
        $room_avs = Room::whereNotIn('id',function($query){
                    $query->select('id_room')->from('rooms_to_hotels');
                })
                    ->where('id_hotel',$hotel)
                    ->take($room)
                    ->get();
        foreach($room_avs as $room_av){
        Rooms_to_hotel::create([
            'id_record'     => $record->id,
            'id_room'       => $room_av->id,
        ]);
        }
        
        
        Bill::create([
            'id_record'     => $record->id,
            'price'         => $price,
            'us_cr'         => Auth::user()->id,
        ]);

        Change::create([
            'description' => 'Registro '.$record->id.' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);

        return;
    }
    public function createRecordPartner($assistant,$event,$plan,$academic_agenda,$room,$hotel,$id_partner,$check_in,$check_out,$price)
    {
        $event = Event::where('id',$event)->first();
        $assistant = Assistant::where('id',$assistant)->first();
        $plan = Plan::where('id',$plan)->first();
        $record = Record::create([
            'id_assistant'  => $assistant->id,
            'id_event'      => $event->id,
            'id_plan'       => $plan->id,
            'enroll_name'   => Auth::user()->names.' '.Auth::user()->last_names,
            'enroll_email'  => $assistant->email,
            'ckeck_in'      => $check_in,
            'check_out'     => $check_out,
            'id_partner'    => $id_partner,
        ]);

 
        $assistantP = Assistant::where('id',$id_partner)->first();
        $recordP = Record::create([
            'id_assistant'  => $assistantP->id,
            'id_event'      => $event->id,
            'id_plan'       => $plan->id,
            'enroll_name'   => Auth::user()->names.' '.Auth::user()->last_names,
            'enroll_email'  => $assistant->email,
            'ckeck_in'      => $check_in,
            'check_out'     => $check_out,
            'id_partner'    => $assistant->id,
        ]);

        Academic_agenda::create([
            'academic_agenda'   => 'AgendaAcademica',
            'id_record'         => $record->id,
        ]);

        // Academic_agenda::create([
        //     'academic_agenda'   => 'AgendaAcademica',
        //     'id_record'         => $recordP->id,
        // ]);

        
        $room_avs = Room::whereNotIn('id',function($query){
                    $query->select('id_room')->from('rooms_to_hotels');
                })
                    ->where('id_hotel',$hotel)
                    ->take($room)
                    ->get();
        foreach($room_avs as $room_av){
        Rooms_to_hotel::create([
            'id_record'     => $record->id,
            'id_room'       => $room_av->id,
        ]);
        }
        
        
        Bill::create([
            'id_record'     => $record->id,
            'price'         => $price,
            'us_cr'         => Auth::user()->id,
        ]);

        Bill::create([
            'id_record'     => $recordP->id,
            'price'         => $price,
            'us_cr'         => Auth::user()->id,
        ]);


        Change::create([
            'description' => 'Registro '.$record->id.' '.$recordP->id.' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
    }
    public function createRecordNoHotel($assistant,$event,$plan,$academic_agenda,$price)
    {   
        $event = Event::where('id',$event)->first();
        $assistant = Assistant::where('id',$assistant)->first();
        $plan = Plan::where('id',$plan)->first();
        $record = Record::create([
            'id_assistant'  => $assistant->id,
            'id_event'      => $event->id,
            'id_plan'       => $plan->id,
            'enroll_name'   => Auth::user()->names.' '.Auth::user()->last_names,
            'enroll_email'  => $assistant->email,
        ]);

        Academic_agenda::create([
            'academic_agenda'   => 'AgendaAcademica',
            'id_record'         => $record->id,
        ]);
    
        Bill::create([
            'id_record'     => $record->id,
            'price'         => $price,
            'us_cr'         => Auth::user()->id,
        ]);

        Change::create([
            'description' => 'Registro '.$record->id.' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);

        return;
    }
    public function getDisponibleNightsByHotel($hotel)
    {
        $room_avs = Room::whereNotIn('id',function($query){
            $query->select('id_room')->from('rooms_to_hotels');
        })
        ->where('id_hotel',$hotel)
        ->get();
        return $room_avs;
    }
    public function getTotalRef($event)
    {
        $record = Record::where('id_event',$event)
                        //->where('Refrigeriodia1',1)
                        // ->orWhere('Refrigeriodia2',1)
                        // ->where('Refrigeriodia3',1)
                        // ->orWhere('Refrigeriodia4',1)
                        // ->orWhere('Almuerzodia1',1)
                        // ->orWhere('Almuerzodia2',1)
                        // ->where('Almuerzodia3',1)
                        // ->orWhere('Cenadia1',1)
                        // ->where('Cenadia2',1)
                        ->where('Cenadia3',1)
                        ->get();
        return $record;
    }
    public function deleteRecord($record)
    {   
            Record::where('id',$record)->delete();
            Academic_agenda::where('id_record',$record)->delete();
            Bill::where('id_record',$record)->delete();
            Rooms_to_hotel::where('id_record',$record)->delete();
            
            //return;

    }
    public function lunchStatus($record,$lunch,$value)
    {
        //echo 'this is the record: '.$record.' and this is the lunch; '.$lunch.' and this is the value: '.$value;
        $recordU = Record::where('id',  $record)
        ->update([
            $lunch => $value
        ]);
       return $recordU;
    }
    

}

