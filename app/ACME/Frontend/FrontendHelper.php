<?php

namespace App\ACME\Frontend;

use View;
use App\ACME\Helper;
use App\Model\PageBuilder;
use App\Model\FrontendThemeSetting;

class FrontendHelper extends Helper
{
//    protected $selectedTheme;
//    protected $pages;
    /**
     * @return mixed
     */
    public function __construct()
    {
        parent::__construct();
        $selectedTheme = FrontendThemeSetting::get()->first();
        $pages = PageBuilder::where('active', 1)->get();
        View::share ( 'selectedTheme', $selectedTheme );
        View::share ( 'pages', $pages );
    }
}