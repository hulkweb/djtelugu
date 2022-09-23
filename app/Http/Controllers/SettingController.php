<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = array();
        $data['settings'] = Setting::all();
        return view('admin.setting.index', $data);
    }
    public function create()
    {
        $data = array();

        return view('admin.setting.create', $data);
    }

    public function show($slug)
    {
        $title = str_replace('-', ' ', $slug);
        $data = array();
        $data['setting'] = Setting::where('title', $title)->first();
        return view('admin.setting.show', $data);
    }

    public function store()
    {
        $request = request();
        $setting = new Setting();

        $setting->property = $request->input('property');
        $setting->value = $request->input('value');

        $setting->save();
        return redirect()->back()->with('success', 'Uploaded Successfully');
    }
    public function update()
    {
        $request = request();
        $setting =  Setting::find($request->input('id'));

        $setting->property = $request->input('property');
        $setting->value = $request->input('value');

        $setting->save();
        return redirect()->back()->with('success', 'Updated Successfully');
    }
    public function delete($id)
    {
        Setting::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function edit($id)
    {
        $data = array();
        $data['setting'] = Setting::find($id);
        return view('admin.setting.edit', $data);
    }
}
