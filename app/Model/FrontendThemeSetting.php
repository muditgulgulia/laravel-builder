<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Validator;

class FrontendThemeSetting extends Model
{
    protected $fillable = [
        'selected_theme',
        'navebar_style',
        'navbar_container_fluid',
        'body_container_fluid',
        'breadcrumb'
    ];
}
