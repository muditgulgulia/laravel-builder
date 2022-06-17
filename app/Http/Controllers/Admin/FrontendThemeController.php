<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ACME\Admin\AdminHelper;
use App\Model\FrontendThemeSetting;


class FrontendThemeController extends AdminHelper
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = FrontendThemeSetting::all();
        return view('admin.themesetting.grid', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theme = FrontendThemeSetting::find($id);
        $themeOptions = AdminHelper::getEnumValues('frontend_theme_settings', 'selected_theme');

        if ($theme) {
            return view('admin.themesetting.edit', compact('theme','themeOptions'));
        }
        flash('Sorry! no theme found')->warning();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        FrontendThemeSetting::find($id)->fill($request->all())->save();

        flash('Theme updated successfully!')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
