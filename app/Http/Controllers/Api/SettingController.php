<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\SettingService;
use App\Traits\ResponseAPI;

class SettingController extends Controller
{
    use ResponseAPI;
    protected $setting_service;

    public function __construct(SettingService $setting_service)
    {
        $this->setting_service = $setting_service;
    }

    public function index(){
        $setting = $this->setting_service->getSetting();
        return $this->success(
            $setting,
            ResponseMessage::FETCHED
        );
    }
}
