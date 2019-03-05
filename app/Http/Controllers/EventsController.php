<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\Http\Requests\CreateEventRequest;
use soColfecar\Http\Requests\UpdateEventRequest;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Event;
use soColfecar\Event_type;
use Auth;

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
        // return redirect()->route('events.index')
        //     ->with('info', 'evento guardado con exito');
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
        $event_types = Event_type::select('event_types.id','event_types.event_type AS label','event_types.description')->where('event_types.id_status',1)->get();
        return $event_types;
    }
}
