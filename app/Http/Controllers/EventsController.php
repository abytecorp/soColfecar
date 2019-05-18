<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\Http\Requests\CreateEventRequest;
use soColfecar\Http\Requests\UpdateEventRequest;
use soColfecar\Http\Requests\CreatePlaceRequest;
use soColfecar\Http\Requests\UpdateEventTypeRequest;
use soColfecar\Http\Requests\CreateEventTypeRequest;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Event;
use soColfecar\Event_type;
use soColfecar\Place;
use Auth;
use DB;

class EventsController extends Controller
{
    public function index()
    {
        $title = "Listado de tipos de evento";
        $events = Event::paginate(6);
        return view('events.index', compact('title','events'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $event_types = Event_type::pluck('event_type', 'id');
        $title = 'Crear un evento';
        return view('events.create', compact('event_types','title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $exploded = explode(',', $request->banner);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0],'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';
        $fileName = str_random().'.'.$extension;
        $path = public_path().'/storage/banner/'.$fileName;
        file_put_contents($path, $decoded);

        Event::create([
            'event' => strtoupper($request->event),
            'id_event_type' => $request->id_event_type,
            'date_init' => $request->date_init,
            'date_end' => $request->date_end,
            'id_status' => 1,
            'banner' => $fileName,
        ]);
        Change::create([
            'description' => 'Creo el  de evento:'.$request->event.' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
            return;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(Event $event)
    {
        $events = Event::all();
        $title = $event->Event;
        return view('events.show', compact('event','title','Events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Event $event)
    {   
        // $Role_types = Role_type::pluck('Role_type', 'id');

        return view('events.edit', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event)
    {   //actualizamos role
        $event->update($request->all());

        Change::create([
            'description' => 'Actualizo evento: '.$request['event'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('Events.index', $event->id)
            ->with('info', 'Evento actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
//
    }
    public function getTiposEventos()
    {
        $event_types = Event_type::get();
        return ($event_types);
    }
    public function getEventTypes()
    {
        $event_types = Event_type::select('event_types.id','event_types.event_type AS label','event_types.description','event_types.event_type','event_types.slug',
        'event_types.icon','event_types.description','event_types.id_status')->where('event_types.id_status',1)->get();
        return $event_types;
    }
    public function getEventTypesAll()
    {
        $event_types = Event_type::select('event_types.id','event_types.event_type AS label','event_types.description','event_types.event_type','event_types.slug',
        'event_types.icon','event_types.description','event_types.id_status')
        ->get();
        return $event_types;
    }
    public function getEventTypeById($event_type)
    {
        $event_types = Event_type::select('event_types.id','event_types.event_type AS label','event_types.description','event_types.event_type','event_types.slug',
        'event_types.icon','event_types.description','event_types.id_status')
        ->where('event_types.id',$event_type)
        ->first();
        return $event_types;
    }
    public function getPlaces(){
        $places = Place::select(DB::raw('CONCAT(places.place," ( ",cities.city," ) ") AS label'),'places.place','places.city_id','places.address')
            ->join('cities','places.city_id','=','cities.id')
            ->get();
        return $places;
    }
    public function placesStore(CreatePlaceRequest $request) {
        Place::create([
            'place' => $request['place'],
            'city_id' => $request['city_id'],
            'address' => $request['address']
        ]);
        Change::create([
            'description' => 'Creo un lugar nuevo: ['.$request->place.'] correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
            return;
    }
    public function eventTypeUpdate(UpdateEventTypeRequest $request)
    {
        $event_type = Event_type::where('id',$request['id'])->first();
        $event_type->update(
            $request->all()
        );
        Change::create([
            'description' => 'Edito el estado de empresa: ['.$request['event_type'].'].',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function storeEventType(CreateEventTypeRequest $request)
    {
        $event_type = Event_type::create($request->all());
        Change::create([
            'description' => 'Creo el tipo de evento: ['.$request['event_type'].'].',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function setEventTypeStatus($setvalue,$id)
    {
        $event_type = Event_type::where('id',$id)->first();
        $event_type['id_status'] = $setvalue;
        $event_type->update();
        if($setvalue == 1){
        Change::create([
            'description' => 'Activo el tipo de evento :'.$event_type['event_type'],
            'id_user' => Auth::user()->id,
            'id_item' => 10
        ]);
        }else{
            Change::create([
                'description' => 'Desactivo el tipo de evento :'.$event_type['event_type'],
                'id_user' => Auth::user()->id,
                'id_item' => 10
            ]);
        }
        return;
    }
    public function getEventsAfter($currentDate)
    {
        $events = Event::select('events.id','events.event','events.banner','events.date_init')
            // ->join('users', 'users.id','=','changes.id_user')
            ->where('events.date_init','>=', $currentDate)
            ->where('events.id_status',1)
            // ->orderBy('changes.created_at','DESC')
            ->get();
        return $events;
    }
}