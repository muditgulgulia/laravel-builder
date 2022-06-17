<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use App\ACME\SingularToPlural;
use App\Model\ModuleCreator;
use App\Model\Permission;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Schema;

class ModuleCreatorController extends AdminHelper
{

    protected $singularToPlural;
    protected $delFile;

    public function __construct()
    {
        $this->singularToPlural = new SingularToPlural();
        if (PHP_OS == 'WINNT') {
            $this->delFile = 'del ';
        } else {
            $this->delFile = 'rm -rf ';
        }
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = ModuleCreator::all();
        return view('admin.module.grid', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.module.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = ModuleCreator::validate($request->all());
        if ($validation->fails()) {
            flash('Please fill all mandatory fields')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        Artisan::call('make:model', ['name' => "Model/" . ucwords($request->module_name)]);
        $makeModelFile = Artisan::output();

        Artisan::call('make:controller', ['name' => $request->controller_related_to . '/' . ucwords($request->module_name) . 'Controller']);
        $makeControllerCommand = Artisan::output();

//        $makeModelFile = "php ../artisan make:model Model/" . ucwords($request->module_name);
//        $makeControllerCommand = "php ../artisan make:controller " . $request->controller_related_to . '/' . ucwords($request->module_name) . 'Controller';

        //view creation
        $createViewFolder = $this->createViews($request);
        list($makeMigration, $makeMigrationCommand) = $this->createMVC($request, $makeModelFile, $makeControllerCommand, $createViewFolder);
        //update module information in database
        ModuleCreator::createModule($request, $makeMigration, $makeMigrationCommand);

        //permission creation
        $permissionName = strtolower($request->module_name);
        Permission::addModulePermission($permissionName);

        flash('Permissions added successfully!')->success();

        return redirect()->back()->with(['makeNewModule' => 'Controller, Model, Migration, View, Permissions etc has been created successfully'], 'default');

    }

    /**
     * @param Request $request
     * @return string
     */
    public function createViews(Request $request)
    {
        if (PHP_OS == 'WINNT') {
            $makeDir = "mkdir " . app()->resourcePath() . $this->separators . "views" . $this->separators . "admin" . $this->separators . strtolower($request->module_name);
            exec($makeDir);
            $createViewFolder = 'copy "' . app()->resourcePath() . $this->separators . 'views' . $this->separators . 'admin' . $this->separators . 'blank" "' . app()->resourcePath() . $this->separators . 'views' . $this->separators . 'admin' . $this->separators . strtolower($request->module_name) . '"';
        } else {
            $createViewFolder = "cp -R " . app()->resourcePath() . $this->separators . "views" . $this->separators . "admin" . $this->separators . "blank " . app()->resourcePath() . $this->separators . "views" . $this->separators . "admin" . $this->separators . strtolower($request->module_name);
        }
        return $createViewFolder;
    }

    /**
     * @param Request $request
     * @param $makeModelMigrationCommand
     * @param $makeControllerCommand
     * @param $createViewFolder
     * @return string
     */
    protected function createMVC(Request $request, $makeModelFile, $makeControllerCommand, $createViewFolder)
    {
        $migrationName = $this->singularToPlural->underscore($this->singularToPlural->pluralize($request->module_name));
        $allMigrationFields = json_decode($request->allMigrationFields);

        list($makeMigration, $makeMigrationCommand) = $this->makeMigrationWithSchema($request, $migrationName, $allMigrationFields);

//        $makeModel = exec($makeModelFile);

        flash($makeModelFile)->success();

        //make controller with resource
        if (isset($request->make_controller_with_resource)) {
            $makeControllerCommand .= " --resource";
        }
        $controller = exec($makeControllerCommand);
        flash($controller)->success();

        //migrate (create table in database with with fields
        if (isset($request->migrate_now)) {
            Artisan::call('migrate');
            $migrate = Artisan::output();
//            $controller = exec('php ../artisan migrate');
            flash($migrate)->success();
        }

        //create view for new module
        if ($request->controller_related_to == 'Admin') {
            $viewCreated = exec($createViewFolder);
            flash($viewCreated)->success();
        }
        return [$makeMigration, $makeMigrationCommand];
    }

    /**
     * @param Request $request
     * @param $migrationName
     * @param $allMigrationFields
     * @return mixed|string
     */
    protected function makeMigrationWithSchema(Request $request, $migrationName, $allMigrationFields)
    {
        //make migration with schema
        $makeMigration = '';
        $makeMigrationCommand = '';
        if (isset($request->make_migration)) {

            $makeMigrationCommand = 'php ' . base_path() . $this->separators . 'artisan make:migration:schema create_' . $migrationName . '_table --model=0 --schema="';
            $makeMigrationCommand = $this->getAllMigrationFields($allMigrationFields, $makeMigrationCommand);
            $makeMigrationCommand = str_replace_last(',', '"', $makeMigrationCommand);
            exec($makeMigrationCommand);

            //ToDO : change find command for windows (without change make migration field empty and not delete when module delete)
            $getLatestMigrationName = "find " . database_path('migrations') . " -name '*create_" . $migrationName . "_table.php*'";
            $files = exec($getLatestMigrationName);
            $makeMigration = last(explode('/', $files));

            $removeUnwnatedModel = $this->delFile . app_path() . $this->separators . ucwords($request->module_name);
            exec($removeUnwnatedModel);

            flash('Migration created successfully : ' . $makeMigration)->success();
        }
        return [$makeMigration, $makeMigrationCommand];
    }

    /**
     * @param $allMigrationFields
     * @param $makeMigrationCommand
     * @return string
     */
    protected function getAllMigrationFields($allMigrationFields, $makeMigrationCommand)
    {
        foreach ($allMigrationFields as $migrationField) {
            $makeMigrationCommand .= $migrationField->name . ':' . $migrationField->data_type;

            if ($migrationField->default_check) {
                if ($migrationField->default == '') {
                    $migrationField->default = '0';
                }

                $makeMigrationCommand .= ':default(' . $migrationField->default . ')';
            }

            if ($migrationField->nullable) {
                $makeMigrationCommand .= ':nullable';
            }

            if ($migrationField->unique) {
                $makeMigrationCommand .= ':unique';
            }
            $makeMigrationCommand .= ',';
        }
        return $makeMigrationCommand;
    }

    public function mm()
    {
        $command = 'php' . base_path() . 'artisan make:migration:schema create_users1_table --model=0 --schema="username:string, email:string:unique"';
        echo exec($command);

        Artisan::call('make:migration:schema create_users2_table --model=0 --schema="username:string, email:string:unique"');
        $migrate = Artisan::output();
        echo $migrate;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findModuelExistOrNot = ModuleCreator::find($id);
        if ($findModuelExistOrNot) {

            $modelPath = $this->delFile . app_path() . $this->separators . "Model" . $this->separators . $findModuelExistOrNot->module_name . ".php";
            list($controllerPath, $viewPath, $migrationPath) = $this->getAllPathForModuleDeletion($findModuelExistOrNot);
            echo $modelPath, $controllerPath, $viewPath, $migrationPath;
//            exit;
            //deleted model controller view migration
            exec($controllerPath);
            exec($viewPath);
            if (PHP_OS != 'WINNT' && $migrationPath != '') {
                exec($migrationPath);
            }
            exec($modelPath);

            //remove permissions
            Permission::removeModulePermission(strtolower($findModuelExistOrNot->module_name));
            $result = $findModuelExistOrNot->delete();
            $alert = [
                'type' => $result ? 1 : 0,
                'message' => $result ? 'Model, Controller, View, and Migration has been deleted successfully' : 'Module deletion failed',
            ];
            flash('Module deleted successfully!')->success();
            return response()->json($alert);
        } else {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back();
        }
    }

    /**
     * @param $findModuelExistOrNot
     * @return array
     */
    protected function getAllPathForModuleDeletion($findModuelExistOrNot)
    {
        //get controller path and check controller related to admin or frontend
        if ($findModuelExistOrNot->controller_related_to == 'Admin') {
            $controllerPath = $this->delFile . app_path() . $this->separators . "Http" . $this->separators . "Controllers" . $this->separators . "Admin" . $this->separators . ucwords($findModuelExistOrNot->module_name) . 'Controller.php';

            if (PHP_OS == 'WINNT') {
                $viewPath = 'rmdir /s ' . app()->resourcePath() . $this->separators . "views" . $this->separators . "admin" . $this->separators . strtolower($findModuelExistOrNot->module_name) . ' /q';
            } else {
                $viewPath = $this->delFile . app()->resourcePath() . $this->separators . "views" . $this->separators . "admin" . $this->separators . strtolower($findModuelExistOrNot->module_name);
            }

        } else {

            $controllerPath = $this->delFile . app_path() . $this->separators . "Http" . $this->separators . "Controllers" . $this->separators . "Frontend" . ucwords($findModuelExistOrNot->module_name);

            $viewPath = "";
        }

        $this->dropDBTableIfExist($findModuelExistOrNot);

        //get migration path
        $migrationPath = '';
        if ($findModuelExistOrNot->make_migration != 'no' && $findModuelExistOrNot->make_migration != '') {
            $migrationName = $findModuelExistOrNot->make_migration;
            $migrationPath = $this->delFile . app()->databasePath() . $this->separators . "migrations" . $this->separators . $migrationName;
            return array($controllerPath, $viewPath, $migrationPath);
        }
        return array($controllerPath, $viewPath, $migrationPath);
    }

    /**
     * @param $findModuelExistOrNot
     * @return string
     */
    protected function dropDBTableIfExist($findModuelExistOrNot)
    {
        $migrationName = $this->singularToPlural->underscore($this->singularToPlural->pluralize($findModuelExistOrNot->module_name));
//        $tables = DB::select('SHOW TABLES');
//        foreach ($tables as $table) {
//            foreach ($table as $key => $value) {
        if (Schema::hasTable($migrationName) == 1) {

            DB::beginTransaction();
            //turn off referential integrity
            DB::statement("DROP TABLE $migrationName");
            //turn referential integrity back on
            DB::commit();
        }
//            }
//        }
        return $migrationName;
    }

    /**
     * @param $status
     * @param $uid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateModuleStatus($status, $uid)
    {
        $checkModuleExistence = ModuleCreator::find($uid);
        if ($checkModuleExistence == null) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back();
        }

        if ($status) {
            $status = 0;
            flash('Module deactivated successfully!')->success();
        } else {
            $status = 1;
            flash('Module activated successfully!')->success();
        }

        $checkModuleExistence->update(['active' => $status]);

        return redirect()->back();
    }
}
