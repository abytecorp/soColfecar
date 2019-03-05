<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreateHotelRequest;
use soColfecar\Hotel;
use soColfecar\Change;
use Auth;

class HotelController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHotelRequest $request)
    {
        $company = Hotel::create([
            'hotel_name' => strtoupper($request['hotel_name']),
            'id_city' => $request['id_city'],
            'address' => $request['address'],
            'email' => $request['email'],
            'web' => $request['web'],
            'stars' => $request['stars'],
        ]);
        Change::create([
            'description' => 'Creo el hotel: '.$request['hotel_name'].' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
            ]);
            return;
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
