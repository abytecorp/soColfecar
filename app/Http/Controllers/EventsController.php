<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\Http\Requests\CreateEventRequest;
use soColfecar\Http\Requests\UpdateEventRequest;
use soColfecar\Http\Requests\CreatePlaceRequest;
use soColfecar\Http\Requests\UpdateEventTypeRequest;
use soColfecar\Http\Requests\CreateEventTypeRequest;
use soColfecar\Http\Requests\CreateHotelToEventRequest;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Event;
use soColfecar\Hotel;
use soColfecar\Event_type;
use soColfecar\Place;
use soColfecar\Hotel_to_event;
use soColfecar\Single_room;
use soColfecar\Double_room;
use soColfecar\Bill;
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

        $event = Event::create([
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
            return $event;

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
            ->orderBy('events.created_at','DESC')
            ->get();
        return $events;
    }
    public function getHotelsByEvent($event)
    {
        $hotelsByEvent = Hotel_to_event::select('hotel_to_events.id AS hotels_to_event_id', 'hotel_to_events.event_id', 'hotel_to_events.hotel_id', 'hotel_to_events.single_rooms', 
            'hotel_to_events.double_rooms', 'hotel_to_events.status_id', 'hotel_to_events.created_at', 'hotel_to_events.updated_at','hotels.hotel_name', 'hotels.id AS hotel_id')
            ->join('hotels','hotel_to_events.hotel_id','hotels.id')
            ->where('hotel_to_events.event_id',$event)
            ->where('hotel_to_events.status_id',1)
            ->get();
        return $hotelsByEvent;
    }
    public function storeHotelToEvent(CreateHotelToEventRequest $request) {
        $hotel = Hotel::where('id',$request->hotel_id)->first();
        $event = Event::where('id',$request->event_id)->first();
        $Hotel_to_event = Hotel_to_event::create($request->all());
        Change::create([
            'description' => 'Asigno el hotel ['.$hotel->hotel_name.'] al evento ['.$event->event.'] correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return $Hotel_to_event;
    }
    public function storeNewBill(Request $request) {
        $bill = Bill::create([
            'id_record' => $request->record_id,
            'price' => $request->price,
            'us_cr' => 28
        ]);
        return $bill;
    }
    public function storeSingleRoom($id)
    {
        $single_room = Single_room::create([
            'hotel_to_event_id' => $id
        ]);
        return $single_room;
    }
    public function storeDoubleRoom($id)
    {
        $double_room = Double_room::create([
            'hotel_to_event_id' => $id
        ]);
        return $double_room;
    }
    public function getRoomsAssigned($hotels_to_event_id)
    {
        $single_rooms = Single_room::where('hotel_to_event_id',$hotels_to_event_id)
            ->where('record_id','!=',null)
            ->get();
        $double_rooms = Double_room::where('hotel_to_event_id',$hotels_to_event_id)
            ->where('record_id','!=',null)
            ->orWhere('companion_id','!=',null)
            ->get();
        //return;
        if($single_rooms){
            return $single_rooms;
        }else if($double_rooms){
            return $double_rooms;
        }else{
            return $single_room;
        }
    }
    public function deleteRooms($hotels_to_event_id)
    {
        $single_rooms=Single_room::where('hotel_to_event_id',$hotels_to_event_id)->delete();
        $double_rooms=Double_room::where('hotel_to_event_id',$hotels_to_event_id)->delete();
        return;
    }
    public function deleteHotelAssign($hotels_to_event_id)
    {
        $hotel_to_event = Hotel_to_event::where('id',$hotels_to_event_id)->delete();
        return;
    }
}