<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Concrete\TermAndConditionService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage;

class TermAndConditionController extends Controller
{
    use ResponseAPI;
    protected $term_service;

    public function __construct(TermAndConditionService $term_service)
    {
        $this->term_service = $term_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('term_and_condition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('terms.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('term_and_condition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->term_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function store(Request $request)
    {

        // abort_if(Gate::denies('term_and_condition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'description' => 'required|string'
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            $response = $this->term_service->update($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('terms')->with('success', ResponseMessage::UPDATE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('term_and_condition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $term = $this->term_service->getById($id);
        return view('terms.create', compact('term'));
    }

}
