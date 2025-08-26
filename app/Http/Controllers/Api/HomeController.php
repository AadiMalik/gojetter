<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\Api\HomeService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ResponseAPI;
    protected $home_service;

    public function __construct(
        HomeService $home_service
    ) {
        $this->home_service = $home_service;
    }

    public function web(){
        $data = $this->home_service->webData();
        return $this->success(
            $data,
            ResponseMessage::FETCHED
        );
    }
}
