<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('settings.index', [
            'settings' => $settings,
        ]);
    }

    public function create()
    {
        return view('settings.create');
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);

        return view('settings.edit', [
            'setting' => $setting
        ]);
    }
    public function store(Request $request)
    {
        $settingAttributes = $request->validate([
            'key' => ['required','unique:settings,key'],
            'value' => ['required'],
        ]);

        $setting = Setting::create($settingAttributes);

        return redirect('/settings/create')->with([
            'message' => "Successfully added the setting $setting->key:$setting->value to settings"
        ]);
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $rules = [
            'key' => ['required','unique:settings,key'],
            'value' => ['required'],
        ];

        if($request->post('key') == $setting->key) {
            unset($rules['key']);
        }

        $settingAttributes = $request->validate($rules);

        $setting->update($settingAttributes);

        return redirect("/settings")->with([
            'message' => "Successfully updated settings to $setting->key:$setting->value"
        ]);
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return redirect("/settings")
            ->with([
                'message' => 'Successfully deleted the setting ' . $setting->key . '.',
            ]);
    }
}
