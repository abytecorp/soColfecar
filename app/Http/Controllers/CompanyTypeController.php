<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\User;
use soColfecar\Change;
use soColfecar\Company_type;
use Auth;

class CompanyTypeController extends Controller
{
    public function index()
    {
        $title = "Tipos de empresa";
        $company_types = Company_type::paginate(6);
        return view('company_types.index', compact('title','company_types'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = 'Crear un Tipo de Empresa';
        return view('company_types.create', compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $company_types = Company_type::create($request->all());

        Change::create([
            'description' => 'Creo el tipo de empresa:'.$request['company_type'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('company_types.index', $company_types->id)
            ->with('info', 'tipo de empresa guardado con exito');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(Company_type $company_type)
    {   
        // $company_type = Company_type::all();
        $title = $company_type->company_type;
        return view('company_types.show', compact('company_types','title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Company_type $company_type)
    {   
        // $Role_types = Role_type::pluck('Role_type', 'id');
     

        return view('company_types.edit', compact('company_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company_type $company_type)
    {   //actualizamos company_types
        $company_type->update($request->all());

        Change::create([
            'description' => 'Actualizo tipo de empresa: '.$request['company_type'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('company_types.index', $company_type->id)
            ->with('info', 'Estado de empresa actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_type $company_type)
    {
        $company_type->delete();

        return back()->with('info', 'Eliminado correctamnte');
    }
}
