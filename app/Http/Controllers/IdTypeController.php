<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\Http\Requests\CreateRoleRequest;
use soColfecar\Http\Requests\UpdateRoleRequest;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Id_type;
use Auth;

class IdTypeController extends Controller
{
    public function index()
    {
        $title = "Listado de tipos de ido";
        $id_types = id_type::paginate(6);
        return view('id_types.index', compact('title','id_types'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $id_types = Id_type::get();
        $title = 'Crear tipo de identificacion';
        return view('id_types.create', compact('id_types','title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $id_type = id_type::create($request->all());

        Change::create([
            'description' => 'Creo el tipo de identificación:'.$request['id_type'].' correctamente.',
            'id_item' => 10,
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('id_types.index', $id_type->id)
            ->with('info', 'producto guardado con exito');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(id_type $id_type)
    {
        $id_types = id_type::all();
        $title = $id_type->id_type;
        return view('id_types.show', compact('id_type','title','id_types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Id_type $id_type)
    {   
        // $Role_types = Role_type::pluck('Role_type', 'id');

        return view('id_types.edit', compact('id_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Id_type $id_type)
    {   //actualizamos role
        $id_type->update($request->all());

        Change::create([
            'description' => 'Actualizo tipo de identificacion: '.$request['id_type'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('id_types.index', $id_type->id)
            ->with('info', 'Tipo de ididentificaciono actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $id_type)
    {
//
    }
}
