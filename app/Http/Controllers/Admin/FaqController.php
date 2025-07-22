<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Concrete\FaqService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage;

class FaqController extends Controller
{
    use ResponseAPI;
    protected $faq_service;

    public function __construct(FaqService $faq_service)
    {
        $this->faq_service = $faq_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('faq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('faqs.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('faq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->faq_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('faq_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('faqs.create');
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('faq_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'question' => 'required|string|max:255',
                'answer' => 'required|string'
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            $response = $this->faq_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('faqs')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('faq_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $faq = $this->faq_service->getById($id);
        return view('faqs.create', compact('faq'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('faq_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $faq = $this->faq_service->statusById($id);
            return $this->success(
                $faq,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('faq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $faq = $this->faq_service->deleteById($id);
            return $this->success(
                $faq,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
