<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Validator;

class SliderInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slider_name', 'status', 'style', 'active_class'
    ];

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
                'slider_name' => 'required|string|max:255|unique:slider_infos,slider_name,' . $id,
            ];
        }

        return [
            'slider_name' => 'required|string|max:255',
        ];
    }
}
