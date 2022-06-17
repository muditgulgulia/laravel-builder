<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use App\Model\Permission;
use App\Model\Role;
use App\Model\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends AdminHelper
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.role.grid', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Role::validate($request->all());

        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        Role::create($request->all());

        flash('Role created successfully!')->success();

        return redirect()->back();
    }

    /**
     * Display all competence.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rolePerms = Role::rolePerms($id);
        $permissions = Permission::all();
        return view('admin.role.permissions', compact('permissions', 'rolePerms','id'));
    }


    /**
     * Store competence
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCompetence(Request $request)
    {
        $attachRolePermissions = Role::find($request->role_id);

        //below  attachPermissions() function for attach permission only
        //$attachRolePermissions->attachPermissions($request->permissions);

        //sync function is use for attach and detach permission
        $attachRolePermissions->perms()->sync($request->permissions);
        flash('Competence updated successfully!')->success();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roleList = Role::find($id);
        if($roleList)
        {
            return view('admin.role.edit', compact('roleList'));
        }
        flash('Sorry! role not found')->warning();

        return redirect()->back();
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Role::validate($request->all(), $id);

        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        Role::updateRole($request->all(), $id);

        flash('Role updated successfully!')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id); // Pull back a given role

        if($role)
        {
            // Force Delete
            $role->users()->sync([$id]); // Delete relationship data
            $role->perms()->sync([$id]); // Delete relationship data

            $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
            $result = 1;
        }
        else
        {
            $result = 0;
        }
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? 'Role has been deleted' : 'Role delete failed',
            'trId' => $id,
        ];
        return response()->json($alert);
        
        //delete all role_user related to role_id
//        RoleUser::where('role_id',$id)->delete();
        
        //delete all role_user related to role_id
//        Permission::where('role_id',$id)->delete();
        
//        $result = $findRoleExistOrNot ? $findRoleExistOrNot->delete() : 0;

    }


}
