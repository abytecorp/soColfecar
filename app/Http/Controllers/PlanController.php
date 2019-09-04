<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Http\Requests\CreatePlanRequest;
use soColfecar\Http\Requests\UpdatePlanRequest;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Plan;
use soColfecar\Event;
use soColfecar\Company_state;
use Auth;

class PlanController extends Controller
{
   

    public function store(CreatePlanRequest $request)
    {  
        $plan = Plan::create($request->all());
        Change::create([
            'description' => 'Creo el plan:'.$request['plan'].' para el evento: '.$request['id_event'].' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);
        return;
    }
    public function update(CreatePlanRequest $request,Plan $plan)
    {   
        $plan->update($request->all());

        Change::create([
            'description' => 'Actualizo el plan: '.$request['plan'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);
        
        return;
    }

    public function destroy(Role $plan)
    {
//
    }
}
