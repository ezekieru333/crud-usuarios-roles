<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:read-rol|create-rol|update-rol|destroy-rol', ['only' => ['index']]);
         $this->middleware('permission:create-rol', ['only' => ['create','store']]);
         $this->middleware('permission:update-rol', ['only' => ['edit','update']]);
         $this->middleware('permission:destroy-rol', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return Inertia::render('roles/Index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return Inertia::render('roles/Create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
    
        $role = Role::create(['guard_name' => 'web', 'name' => $request->name]);
        $role->syncPermissions($request->permissions);
    
        return redirect()->route('roles.index');   
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
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = $role->permissions->pluck('name');
    
        return Inertia::render('roles/Edit', ['role' => $role,'permissions' => $permissions,'rolePermissions' => $rolePermissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        
        $request->validate( [
            'name' => 'required',
            'permissions' => 'required',
        ]);
        
        $role->name = $request->name;
        $role->save();
    
        $role->syncPermissions($request->permissions);
    
        return redirect()->route('roles.index');         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index');      
    }
}
