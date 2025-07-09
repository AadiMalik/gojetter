<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Concrete\PolicyService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage;

class PolicyController extends Controller
{
    use ResponseAPI;
    protected $policy_service;

    public function __construct(PolicyService $policy_service)
    {
        $this->policy_service = $policy_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('private_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('policy.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('private_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->policy_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function store(Request $request)
    {

        // abort_if(Gate::denies('private_policy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

            $response = $this->policy_service->update($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('policy')->with('message', ResponseMessage::UPDATE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('private_policy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $policy = $this->policy_service->getById($id);
        return view('policy.create', compact('policy'));
    }
}
