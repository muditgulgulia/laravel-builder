<?php

namespace App\Http\Controllers\Admin;

use App\ACME\Admin\AdminHelper;
use App\Model\SliderConfiguration;
use App\Model\SliderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SliderController extends AdminHelper
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allSliders = SliderInfo::all();
        return view('admin.slider.grid', compact('allSliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = SliderInfo::validate($request->all());
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }
        SliderInfo::create($request->all());
        flash('slider created successfully!')->success();
        return redirect()->back();
    }

    /**
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = SliderInfo::find($id);

        if ($slider) {
            return view('admin.slider.edit', compact('slider'));
        }
        flash('Sorry! no slider found')->warning();

        return redirect()->back();
    }


    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = SliderInfo::find($id);
        if ($slider) {
            $slider->fill($request->all())->save();
            flash('Slider updated successfully!')->success();
        } else {
            flash('Slider not update please try again!')->success();
        }

        return redirect()->back();
    }


    /**
     * show all ready sliders list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showConfiguredSlider()
    {
        $configuredSliders = SliderConfiguration::all();
        return view('admin.slider.configuredsliders.grid', compact('configuredSliders'));
    }

    /**
     * create new slider and add configuration
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addConfiguredSlider()
    {
        $captionPosition = [0=>'Top Left', 1=>'Top Right', 2=>'Bottom Left', 3=>'Bottom Right', 4=>'Center'];
        $sliderList = SliderInfo::get()->pluck('slider_name', 'id')->prepend('None', '0');
        return view('admin.slider.configuredsliders.create', compact('sliderList','captionPosition'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeConfiguredSlider(Request $request)
    {
        dd($request->all());
        return view('admin.slider.configuredsliders.create');
    }

}
