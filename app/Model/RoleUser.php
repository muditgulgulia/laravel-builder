<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_id'
    ];
    protected $primaryKey = 'user_id';
    
    protected $table = 'role_user';

    /**
     * @param $userId
     * @return array
     */
    public static function pluckUserAndRoleIds($userId)
    {
        return static::where('user_id', $userId)->pluck('role_id')->toArray();
    }
}
