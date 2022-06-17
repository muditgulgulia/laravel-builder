<?php

namespace App\Http\Controllers;

use App\ACME\Admin\AdminHelper;
use \Illuminate\Support\Facades\Artisan;

class DashboardController extends AdminHelper
{
    /**
     * @param string $module //moduleName
     * @param string $functionParameter
     * @param string $functionParameter2
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param string $functionParameter1
     * @internal param string $functionParameter
     */
    public function adminDashboard($module = '', $functionParameter = '', $functionParameter2 = '')
    {

        if ($module != '' || $functionParameter != '') {

            $functionName = $this->getFunctionName($functionParameter, $functionParameter2);
            return $this->customRoutes($module, $functionName, $functionParameter2);

        } else {
            return view('admin.index');
        }
    }

    /**
     * @param $functionParameter
     * @param $functionParameter2
     * @return string
     */
    protected function getFunctionName($functionParameter, $functionParameter2)
    {
        if ($functionParameter == '' && ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'HEAD')) {
            $functionName = 'index';
            return $functionName;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $functionParameter == '') {
            $functionName = 'store';
            return $functionName;
        } elseif ($functionParameter == 'create' && ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'HEAD')) {
            $functionName = $functionParameter;
            return $functionName;
        } elseif ($functionParameter != '' && ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'HEAD')) {
            $functionName = 'show';
            return $functionName;
        } elseif ($functionParameter != '' && ($_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'PATCH')) {
            $functionName = 'update';
            return $functionName;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $functionParameter != '') {
            $functionName = 'destroy';
            return $functionName;
        } elseif ($functionParameter2 != '') {
            $functionName = $functionParameter2;
            return $functionName;
        } else {
            $functionName = 'index';
            return $functionName;
        }
    }

    /**
     * @param $module
     * @param $functionName
     * @param $functionParameter
     */
    public function customRoutes($module, $functionName, $functionParameter)
    {
        $setControllerName = ucwords($module . 'Controller');
        $setNameSpaceWithControllerName = "\\App\\Http\\Controllers\\Admin\\" . $setControllerName;
        $controllerNameSpace = new $setNameSpaceWithControllerName();

        if ($functionName != 'index' && $functionName != 'create') {
            $controllerNameSpace->$functionName($functionParameter);
        } else {
            $controllerNameSpace->$functionName();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function errorsView()
    {
        return view('errors.admin.401');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cacheManagement()
    {
        Artisan::call('view:clear');
        $output = Artisan::output();
        flash($output)->success();

        Artisan::call('clear-compiled');
        $output = Artisan::output();
        flash($output)->success();
        return redirect()->back();
    }
}
