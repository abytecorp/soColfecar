<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\Http\Requests\CreateRoleRequest;
use soColfecar\Http\Requests\UpdateRoleRequest;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Event_type;
use Auth;


class EventTypesController extends Controller
{
    public function index()
    {
        $title = "Listado de tipos de evento";
        $event_types = Event_type::paginate(6);
        return view('event_types.index', compact('title','event_types'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $event_types = Event_type::get();
        $title = 'Crear tipo de evento';
        return view('event_types.create', compact('event_types','title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $event_type = Event_type::create($request->all());

        Change::create([
            'description' => 'Creo el tipo de evento:'.$request['event_type'].' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('event_types.index', $event_type->id)
            ->with('info', 'producto guardado con exito');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(Event_type $event_type)
    {
        $event_types = Event_type::all();
        $title = $event_type->event_type;
        return view('event_types.show', compact('event_type','title','event_types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Event_type $event_type)
    {   
        // $Role_types = Role_type::pluck('Role_type', 'id');

        return view('event_types.edit', compact('event_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event_type $event_type)
    {   //actualizamos role
        $event_type->update($request->all());

        Change::create([
            'description' => 'Actualizo role: '.$request['event_type'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('event_types.index', $event_type->id)
            ->with('info', 'Tipo de evento actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $event_type)
    {
//
    }
}
