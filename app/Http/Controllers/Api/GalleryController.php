<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\GalleryService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use ResponseAPI;
    protected $gallery_service;

    public function __construct(
        GalleryService $gallery_service
    ) {
        $this->gallery_service = $gallery_service;
    }

    public function index(){
        $gallery = $this->gallery_service->getAll();
        return $this->success(
            $gallery,
            ResponseMessage::FETCHED
        );
    }
}
