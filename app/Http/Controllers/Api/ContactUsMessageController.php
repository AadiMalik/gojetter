<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactUsMessageRequest;
use App\Services\Concrete\ContactUsMessageService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class ContactUsMessageController extends Controller
{
    use ResponseAPI;
    protected $contact_us_message_service;

    public function __construct(ContactUsMessageService $contact_us_message_service)
    {
        $this->contact_us_message_service = $contact_us_message_service;
    }

    //contact us save
    public function store(StoreContactUsMessageRequest $request)
    {
        $contact_us_message = $this->contact_us_message_service->save($request->validated());
        return $this->success(
            $contact_us_message,
            ResponseMessage::SAVE
        );
    }
}
