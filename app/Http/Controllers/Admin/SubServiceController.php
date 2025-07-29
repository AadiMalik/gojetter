<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ServicesService;
use Illuminate\Http\Request;
use App\Services\Concrete\SubServicesService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SubServiceController extends Controller
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

    public function index()
    {
        // abort_if(Gate::denies('sub_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('sub_services.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('sub_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->sub_services_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('sub_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $services = $this->services_service->getActiveAll();
        return view('sub_services.create',compact('services'));
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('sub_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'service_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:sub_services,slug,' . ($request->id ?? 'null') . ',id',
                'image' => 'nullable|image',
                'description' => 'nullable|string',
                'has_customer_form' => 'boolean|in:0,1'
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('image')) {
                $obj['image'] = $request->file('image')->store('sub_services', 'public');
            }

            $response = $this->sub_services_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('sub-services')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('sub_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $services = $this->services_service->getActiveAll();
        $sub_service = $this->sub_services_service->getById($id);
        return view('sub_services.create', compact('services','sub_service'));
    }

    public function view($id)
    {
        // abort_if(Gate::denies('sub_service_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sub_service = $this->sub_services_service->getById($id);
        return view('sub_services.view', compact('sub_service'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('sub_service_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $sub_service = $this->sub_services_service->statusById($id);
            return $this->success(
                $sub_service,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('sub_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $sub_service = $this->sub_services_service->deleteById($id);
            return $this->success(
                $sub_service,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
