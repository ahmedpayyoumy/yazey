<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function detail()
    {
        $settings = Setting::all()->mapWithKeys(function ($item) {
            return [$item['name'] => $item['value']];
        });
        return view('settings.detail', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $skipConfig = ['_token', 'logo'];
        foreach ($request->all() as $name => $value) {
            if (in_array($name, $skipConfig)) {
                continue;
            }

            Setting::updateOrCreate([
                'name' => $name
            ], [
                'value' => $value
            ]);
        }
        
        // Handle logo upload
        if ($file = $request->file('logo')) {
            $settingLogo = Setting::where('name', 'logo')->first();
            if (!empty($settingLogo->value)) {
                Storage::delete($settingLogo->value);
            }
            $logoPath = $file->store('logo');
            $settingLogo->update(['value' => $logoPath]);
        }
        
        toastr()->success('Cập nhật setting thành công!');
        return redirect()->route('settings.detail');
    }
}
