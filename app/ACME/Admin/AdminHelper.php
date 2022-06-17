<?php

namespace App\ACME\Admin;

use \Illuminate\Support\Facades\DB;
use App\Model\User;
use App\ACME\Helper;
use App\Model\RoleUser;
use App\Model\ModuleCreator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminHelper extends Helper
{

    /**
     * AdminHelper constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $customModule = ModuleCreator::get();
        View::share ( 'customModule', $customModule );
    }
    /**
     * @return mixed
     */
    public function authenticateUser()
    {
        $email = Auth::user()->email;
        $userId = User::where('email', $email)->value('id');
        $roleId = RoleUser::where('user_id', $userId)->value('role_id');
        return $roleId;
    }

    /**
     * @param $table
     * @param $column
     * @return array
     */
    public static function getEnumValues($table, $column) {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = \Illuminate\Support\Arr::add($enum, $v, $v);
        }
        return $enum;
    }
}