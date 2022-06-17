<?php

namespace App\Model;

use Validator;
use Illuminate\Database\Eloquent\Model;

class ModuleCreator extends Model
{
    protected $fillable = [
        'module_name', 'migration_fields', 'active', 'controller_related_to', 'make_migration'
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
                'module_name' => 'required|string|max:191|unique:module_creators,module_name,' . $id,
            ];
        }

        return [

            'module_name' => 'required|string|max:191|unique:module_creators,module_name',
        ];
    }

    /**
     * @param $moduleDetails
     * @param $id
     * @return mixed
     */
    public static function updateModule($moduleDetails, $id)
    {
        return static::find($id)->fill($moduleDetails)->save();
    }

    /**
     * @param $request
     * @return $this|Model
     */
    public static function createModule($request,$makeMigration,$makeMigrationCommand)
    {
        return static::create(['module_name' => $request->module_name,'migration_fields'=>$makeMigrationCommand, 'active' => $request->active, 'make_migration' => $makeMigration, 'controller_related_to' => $request->controller_related_to]);
    }
}
