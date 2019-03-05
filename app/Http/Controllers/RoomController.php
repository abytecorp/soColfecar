<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateAssistantFastRequest;
use Caffeinated\Shinobi\Models\Role;
use soColfecar\Company_state;
use soColfecar\Company_type;
use soColfecar\Change;
use soColfecar\Company;
use soColfecar\Room;
use Auth;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for($i = 1; $i <= $request['room_number']; $i++){
            Room::create([
                'room_number'   => $i,
                'id_hotel'      => $request['id_hotel'], 
            ]);
        }

        Change::create([
            'description' => 'Creo Numero de noches: '.$request['room_number'].' correctamente.',
            'id_item' => 10,
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
}
