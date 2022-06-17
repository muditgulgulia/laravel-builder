<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use App\Model\PageBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageBuilderController extends AdminHelper
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = PageBuilder::all();
        return view('admin.pagebuilder.grid',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pagebuilder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = PageBuilder::validate($request->all());

        if ($validation->fails()) {
            flash('Please fill all mandatory fields')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        PageBuilder::create($request->all());

        flash('Role created successfully!')->success();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = PageBuilder::find($id);
        if($page)
        {
            return view('admin.pagebuilder.edit', compact('page'));
        }
        flash('Sorry! no page found')->warning();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = PageBuilder::validate($request->all(), $id);

        if ($validation->fails()) {
            flash('oOps!Something went wrong')->warning();
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        PageBuilder::updatePage($request->all(), $id);

        flash('Page content updated successfully!')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findPageExistOrNot = PageBuilder::find($id);
        $result = $findPageExistOrNot->delete();
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? 'Page has been deleted' : 'Page deletion failed',
            'trId' => $id,
        ];
        flash('Page deleted successfully!')->success();
        return response()->json($alert);
    }
}
