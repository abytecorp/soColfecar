<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Company_state;
use Auth;

class CompanyStateController extends Controller
{
    public function index()
    {
        $title = "Estados de una empresa";
        $company_states = Company_state::paginate(6);
        return view('company_states.index', compact('title','company_states'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = 'Crear un Estado de Empresa';
        return view('company_states.create', compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $company_states = Company_state::create($request->all());

        Change::create([
            'description' => 'Creo el estado de empresa:'.$request['company_state'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('company_states.index', $company_states->id)
            ->with('info', 'estado de empresa guardado con exito');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(Company_state $company_state)
    {   
        // $company_state = Company_state::all();
        $title = $company_state->company_state;
        return view('company_states.show', compact('company_state','title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Company_state $company_state)
    {   
        // $Role_types = Role_type::pluck('Role_type', 'id');
     

        return view('company_states.edit', compact('company_state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company_state $company_state)
    {   //actualizamos company_states
        $company_state->update($request->all());

        Change::create([
            'description' => 'Actualizo estado de empresa: '.$request['company_state'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('company_states.index', $company_state->id)
            ->with('info', 'Estado de empresa actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_state $company_state)
    {
        $company_state->delete();

        return back()->with('info', 'Eliminado correctamnte');
    }
}
