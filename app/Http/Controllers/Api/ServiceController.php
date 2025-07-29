<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ServicesService;
use App\Services\Concrete\SubServicesService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ResponseAPI;
    protected $services_service;
    protected $sub_services_service;

    public function __construct(
        ServicesService $services_service,
        SubServicesService $sub_services_service
    ) {
        $this->services_service = $services_service;
        $this->sub_services_service = $sub_services_service;
    }

    //service
    public function serviceList(){
        $services = $this->services_service->getActiveAll();
        return $this->success(
            $services,
            ResponseMessage::FETCHED
        );
    }

    //service by slug
    public function serviceBySlug($slug){
        $service = $this->services_service->getBySlug($slug);
        return $this->success(
            $service,
            ResponseMessage::FETCHED_DETAIL
        );
    }

    //sub service
    public function subServiceList(){
        $sub_services = $this->sub_services_service->getActiveAll();
        return $this->success(
            $sub_services,
            ResponseMessage::FETCHED
        );
    }

    //sub service by slug
    public function subServiceBySlug($slug){
        $sub_service = $this->sub_services_service->getBySlug($slug);
        return $this->success(
            $sub_service,
            ResponseMessage::FETCHED_DETAIL
        );
    }
}
