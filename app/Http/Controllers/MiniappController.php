<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Assistant;
use soColfecar\Record;

class MiniappController extends Controller
{
    public function login()
    {
        return view('mini-app.login');
    }
    public function validateAssistant(Request $request)
    {
        //dd($request->id_number);
        $assistant= Assistant::where('id_number',$request->id_number)
                ->first();
        //dd($assistant);
       
       
        if($assistant){
            $record= Record::where('id_assistant',$assistant->id)
            ->first();
            $title = $assistant->names.' '.$assistant->last_names;
            return view('mini-app.menu',compact('record','title'));
        }else{
            return 'No se encuentra su documento en la base de datos acerquese a un punto de atencion!';
        }
    }
    public function plan()
    {
        $title = 'Plano';
        return view('mini-app.plan',compact('title'));
    }
    public function mapFull()
    {
        $title = 'Plano';
        return view('mini-app.mapfull',compact('title'));
    }
}


//UPDATE `records` SET `Refrigeriodia1`=2,`Refrigeriodia2`=2,`Refrigeriodia3`=2,`Refrigeriodia4`=2,`Almuerzodia1`=2,`Almuerzodia2`=2,`Almuerzodia3`=2,`Cenadia1`=2,`Cenadia2`=2,`Cenadia3`=2 WHERE `id_plan` = 41

//UPDATE `records` SET `Refrigeriodia1`=0,`Refrigeriodia2`=0,`Refrigeriodia3`=0,`Refrigeriodia4`=0,`Almuerzodia1`=0,`Almuerzodia2`=0,`Almuerzodia3`=0,`Cenadia1`=0,`Cenadia2`=0,`Cenadia3`=0 WHERE `id_plan` = 