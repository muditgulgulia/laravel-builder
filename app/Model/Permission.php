<?php

namespace App\Model;

use Validator;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    /**
     * @param $data
     * @param null $id
     * @return mixed
     */
    public static function validate($data, $id = null)
    {
        return Validator::make($data, static::rules($id));
    }

    /**
     * Validation Rules
     * @param null $id
     * @return array
     */
    public static function rules($id = null)
    {
        if ($id) {
            return [
                'name' => 'required|string|max:191|unique:permissions,name,' . $id,
                'display_name' => 'max:191',
                'description' => 'max:191|',
            ];
        }

        return [
            'name' => 'required|string|max:191|unique:permissions',
            'display_name' => 'max:191',
            'description' => 'max:191|',
        ];
    }

    /**
     * @param $roleDetails
     * @param $id
     */
    public static function updatePermission($permissionDetails, $id)
    {
        $userIdForUpdate = static::find($id);
        $userIdForUpdate->fill($permissionDetails)->save();
    }

    /**
     * @param $permissionName
     * @return bool
     */
    public static function addModulePermission($permissionName)
    {
        $permissions = array(
            array('name'=>$permissionName.'.index', 'display_name'=> $permissionName . ' index', 'description'=> $permissionName . ' index'),
            array('name'=>$permissionName.'.edit', 'display_name'=> $permissionName . ' edit', 'description'=> $permissionName . ' edit'),
            array('name'=>$permissionName.'.show', 'display_name'=> $permissionName . ' show', 'description'=> $permissionName . ' show'),
            array('name'=>$permissionName.'.update', 'display_name'=> $permissionName . ' update', 'description'=> $permissionName . ' update'),
            array('name'=>$permissionName.'.destroy', 'display_name'=> $permissionName . ' destroy', 'description'=> $permissionName . ' destroy'),
            array('name'=>$permissionName.'.create', 'display_name'=> $permissionName . ' create', 'description'=> $permissionName . ' create'),
            array('name'=>$permissionName.'.store', 'display_name'=> $permissionName . ' store', 'description'=> $permissionName . ' store'),
        );

       return static::insert($permissions); // Eloquent approach
    }

    /**
     * @param $permissionName
     * @return bool
     */
    public static function removeModulePermission($permissionName)
    {
        static::where('name',$permissionName.'.index')
            ->orWhere('name',$permissionName.'.edit')
            ->orWhere('name',$permissionName.'.show')
            ->orWhere('name',$permissionName.'.update')
            ->orWhere('name',$permissionName.'.destroy')
            ->orWhere('name',$permissionName.'.create')
            ->orWhere('name',$permissionName.'.store')
            ->delete();
    }
}