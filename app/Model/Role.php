<?php

namespace App\Model;

use Validator;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
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
                'name' => 'required|string|max:191|unique:roles,name,' . $id,
                'display_name' => 'string|max:191',
                'description' => 'max:191|',
            ];
        }

        return [

            'name' => 'required|string|max:191|unique:roles',
            'display_name' => 'string|max:191',
            'description' => 'max:191|',
        ];
    }

    /**
     * Save role's permissions
     * @param $id
     * @param array $perms
     * @return mixed
     */
    public static function savePerms($id, $perms = [])
    {
        $role = static::getById($id);
        return $role->perms()->sync($perms);
    }

    /**
     * Get role's permissions
     * @param $id
     * @return array
     */
    public static function rolePerms($id)
    {
        $perms = [];
        $permissions = static::getById($id)->perms()->get();
        foreach ($permissions as $item) {
            $perms[$item->id] = $item->name;
        }
        return $perms;
    }

    /**
     * @param $id
     * @return mixed|static
     */
    public static function getById($id)
    {
        return static::find($id);
    }

    /**
     * @param $roleDetails
     * @param $id
     */
    public static function updateRole($roleDetails, $id)
    {
        $userIdForUpdate = static::getById($id);
        $userIdForUpdate->fill($roleDetails)->save();

    }
}
