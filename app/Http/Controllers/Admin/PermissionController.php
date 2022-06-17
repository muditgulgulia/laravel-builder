<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use App\Http\Controllers\Controller;
use App\Model\Permission;
use Illuminate\Http\Request;

class PermissionController extends AdminHelper
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('admin.permission.grid',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Permission::validate($request->all());

        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        Permission::create($request->all());

        flash('Permission created successfully!')->success();

        return redirect()->back();
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
        $permissions = Permission::find($id);

        if($permissions)
        {
            return view('admin.permission.edit', compact('permissions'));
        }
        flash('Sorry! permission not found')->warning();

        return redirect()->back();

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
        $validation = Permission::validate($request->all(), $id);

        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        Permission::updatePermission($request->all(), $id);

        flash('Permission updated successfully!')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findPermissionExistOrNot = Permission::find($id);
        $result =  $findPermissionExistOrNot ?   $findPermissionExistOrNot->delete() :  0;

        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? 'Permission has been deleted' : 'Permission delete failed',
            'trId' => $id,
        ];
        return response()->json($alert);
    }
}
