<?php

namespace App\Model;

use Validator;
use App\Model\Role;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    public static $messages = [
        'phone_number.max' => 'Phone number should be greater then 12 digit',
        'phone_number.min' => 'Phone number should be less then 10 digit',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'user_name','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validate($data, $id = null)
    {
        return Validator::make($data, static::rules($id), static::$messages);
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
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'user_name' => 'required|max:255|unique:users,user_name,' . $id,
                'password' => 'sometimes',
                'phone_number' => 'required|numeric|min:1000000000|max:999999999999|unique:users,phone_number,' . $id,
            ];
        }

        return [

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_name' => 'required|max:255|unique:users',
            'phone_number' => 'required|numeric|min:1000000000|max:999999999999|unique:users',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getIndex()
    {
        //Here 1 is admin id.
        return static::where('id','!=',1)->orderBy('id', 'desc')->get();
    }

    /**
     * @param $field
     * @param $equalTo
     * @param $value
     * @return mixed
     */
    public static function getUserValue($field, $equalTo, $value)
    {
        return static::where($field,$equalTo)->value($value);
    }
}
