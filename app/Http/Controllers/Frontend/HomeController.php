<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Model\PageBuilder;
use Illuminate\Http\Request;

use App\Model\FrontendThemeSetting;
use App\ACME\Frontend\FrontendHelper;

class HomeController extends FrontendHelper
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function rootRedirection()
    {
        return view('frontend.index');
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPage($slug)
    {
        return view('frontend.index', compact('slug'));
    }

}
