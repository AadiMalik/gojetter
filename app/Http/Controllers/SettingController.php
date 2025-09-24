<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessage;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Services\Concrete\SettingService;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    use ResponseAPI;
    protected $setting_service;

    public function __construct(SettingService $setting_service)
    {
        $this->setting_service = $setting_service;
    }

    //create
    public function create()
    {
        // abort_if(Gate::denies('setting_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $setting = $this->setting_service->getSetting();
        return view('setting.create', compact('setting'));
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('setting_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validation = Validator::make(
            $request->all(),
            [
                'app_name' => 'nullable|string|max:255',
                'support_email' => 'nullable|email|max:255',
                'contact_number' => 'nullable|string|max:20',

                'tab_logo' => 'nullable|image',
                'admin_panel_logo' => 'nullable|image',
                'mobile_application_logo' => 'nullable|image',
                'mobile_application_home_image' => 'nullable|image',
                'website_logo' => 'nullable|image',
                'website_page_image' => 'nullable|image',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            // images handle
            $imageFields = [
                'tab_logo',
                'admin_panel_logo',
                'mobile_application_logo',
                'mobile_application_home_image',
                'website_logo',
                'website_page_image'
            ];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    $obj[$field] = $request->file($field)->store('settings', 'public');
                }
            }

            // save via service (agar id hai to update, warna create)
            $response = $this->setting_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect()->back()->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }
}
