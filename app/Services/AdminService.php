<?php

namespace App\Services;

use App\Model\RoleUser;
use App\Model\User;

class AdminService{

    protected static $instance;

    /**
     * @return CompanyAdminService
     */
    public static function getInstance() {
        if (self::$instance != NULL) return self::$instance;
        self::$instance = new self();
        return self::$instance;
    }

    /**
     * Add a new user by Admin
     * @param $userData
     */
    public function addUser($userData){
       $userData['password'] = bcrypt($userData['password']);
       $user = User::create($userData);
       RoleUser::create(['role_id'=>2,'user_id'=>$user->id]);
    }
    /**
     * Edit user by Admin
     * @param $userData
     */
    public function updateUser($userData, $userid){

        if (isset($userData['password']) && $userData['password'] != null) {
            $userData['password'] = bcrypt($userData['password']);
        }
        else
        {
            unset($userData['password']);
        }
        $userIdForUpdate = User::find($userid);
        $userIdForUpdate->fill($userData)->save();
    }

}