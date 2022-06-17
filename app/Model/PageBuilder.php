<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Validator;

class PageBuilder extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'active','menu_option'
    ];

    /**
     * @param $requestedData
     * @param null $id
     * @return mixed
     * @internal param $data
     */
    public static function validate($requestedData, $id = null)
    {
        return Validator::make($requestedData, static::rules($id));
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
                'title' => 'required|string|max:191|unique:page_builders,title,' . $id,
                'slug' => 'required|string|max:191|unique:page_builders,slug,' . $id,
                'content' => 'required|min:10',
            ];
        }

        return [

            'title' => 'required|string|max:191|unique:page_builders,title',
            'slug' => 'required|string|max:191|unique:page_builders,slug',
            'content' => 'required|min:10',
        ];
    }

    /**
     * @param $pageDetails
     * @param $id
     * @return mixed
     */
    public static function updatePage($pageDetails, $id)
    {
        return static::find($id)->fill($pageDetails)->save();
    }
}
