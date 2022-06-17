<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use App\Model\Role;
use App\Model\RoleUser;
use App\Model\User;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends AdminHelper
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $allUsers = User::getIndex();

        return view('admin.user.grid', compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = User::validate($request->all());
        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        AdminService::getInstance()->addUser($request->all());

        flash('User created successfully!')->success();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     * Attach or detach roles
     * @param $userId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($userId)
    {
        $getAllAttachedRoles = RoleUser::pluckUserAndRoleIds($userId);
        $roles = Role::all();

        return view('admin.roleuser.role-user', compact('getAllAttachedRoles', 'roles', 'userId'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUserRoles(Request $request)
    {
        $user = User::find($request->user_id);

        $user->roles()->sync($request->roleuser);

        flash('Roles attached successfully!')->success();

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
        $userList = User::find($id);
        if ($userList) {
            return view('admin.user.edit', compact('userList'));
        }

        flash('Sorry! user not found')->warning();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = User::validate($request->all(), $id);
        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        AdminService::getInstance()->updateUser($request->all(), $id);
        flash('User updated successfully!')->success();

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
        $findUserExistOrNot = User::find($id);
        $result = $findUserExistOrNot->delete();
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? 'User has been deleted' : 'User delete failed',
            'trId' => $id,
        ];
//        flash('User Deleted successfully!')->success();
        return response()->json($alert);
    }

    /**
     * @param $status
     * @param $uid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserStatus($status, $uid)
    {
        $checkUserExistence = User::find($uid);
        if ($checkUserExistence == null) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back();
        }

        if($status)
        {
            $status = 0;
            flash('User deactivated successfully!')->success();
        }
        else
        {
            $status = 1;
            flash('User activated successfully!')->success();
        }

        $checkUserExistence->update(['active' => $status]);

        return redirect()->back();
    }
}
