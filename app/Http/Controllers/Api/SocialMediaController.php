<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\SocialMediaService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    use ResponseAPI;
    protected $social_media_service;

    public function __construct(SocialMediaService $social_media_service)
    {
        $this->social_media_service = $social_media_service;
    }

    public function index(){
        $social_media = $this->social_media_service->getAll();
        return $this->success(
            $social_media,
            ResponseMessage::FETCHED
        );
    }
}
