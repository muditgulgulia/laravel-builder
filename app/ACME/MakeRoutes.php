<?php
/**
 * Created by PhpStorm.
 * User: sunarcphp
 * Date: 27/9/17
 * Time: 2:38 PM
 */

namespace App\ACME;

use App\Model\ModuleCreator;
use Schema;

class MakeRoutes
{
    public function getModuleName()
    {
        if (Schema::hasTable('module_creators')) {
            return ModuleCreator::get();
        } else {
            return null;
        }
    }
}