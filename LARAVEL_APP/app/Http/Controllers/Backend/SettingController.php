<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller{
    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository){
        $this->settingRepository = $settingRepository;
    }

    public function index(){
        $settings = $this->settingRepository->all();
        return view('backend.settings.index', compact('settings'));
    }
    
    public function update(Request $request, Setting $setting){
        if(setting::find($setting->id)){
            $request->validate([
                'value' => ['required', 'string', 'max:1000'],
            ]);
            
            try {
                DB::beginTransaction();
                $this->settingRepository->update($setting->id, $request->all());
                
                Cache::forget('siteSettings');
                $siteSettings = cache()->remember(
                    'siteSettings',
                    3600,
                    fn() => Setting::all()->keyBy('key')
                );
                view()->share('siteSettings', $siteSettings);

                DB::commit();
                toastr()->success('Setting has been updated successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Setting Not Found!');
            return redirect()->back();
        }
    }
}