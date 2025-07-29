<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ServicesService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    use ResponseAPI;
    protected $services_service;

    public function __construct(
        ServicesService $services_service
    ) {
        $this->services_service = $services_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('services.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->services_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('services.create');
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:services,slug,' . ($request->id ?? 'null') . ',id',
                'image' => 'nullable|image',
                'description' => 'nullable|string',
                'has_contact_form' => 'boolean|in:0,1'
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('image')) {
                $obj['image'] = $request->file('image')->store('services', 'public');
            }

            $response = $this->services_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('services')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = $this->services_service->getById($id);
        return view('services.create', compact('service'));
    }

    public function view($id)
    {
        // abort_if(Gate::denies('service_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $service = $this->services_service->getById($id);
        return view('services.view', compact('service'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('service_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $service = $this->services_service->statusById($id);
            return $this->success(
                $service,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $service = $this->services_service->deleteById($id);
            return $this->success(
                $service,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
