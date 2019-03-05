<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use soColfecar\Http\Requests\CreateRoleRequest;
use soColfecar\Http\Requests\UpdateRoleRequest;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use soColfecar\User;
use soColfecar\Change;
use Auth;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Listado de Roles";
        $roles = Role::paginate(6);
        return view('roles.index', compact('title','roles'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $permissions = Permission::get();
        $title = 'Crear Role';
        return view('roles.create', compact('permissions','title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $role = Role::create($request->all());
                //actualizamos permisos
        $role->permissions()->sync($request->get('permissions'));

        Change::create([
            'description' => 'Creo el Role:'.$request['name'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('roles.index', $role->id)
            ->with('info', 'producto guardado con exito');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show(Role $role)
    {
        $roles = Role::all();
        $title = $role->name.' '.$role->last_name;
        return view('roles.show', compact('role','title','roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Role $role)
    {   
        // $Role_types = Role_type::pluck('Role_type', 'id');
        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $role)
    {   //actualizamos role
        $role->update($request->all());

        //actualizamos permisos
        $role->permissions()->sync($request->get('permissions'));

        Change::create([
            'description' => 'Actualizo role: '.$request['name'].' correctamente.',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('roles.index', $role->id)
            ->with('info', 'Role actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('info', 'Eliminado correctamnte');
    }
}
