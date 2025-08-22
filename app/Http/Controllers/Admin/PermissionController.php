<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\PermissionService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    use ResponseAPI;
    protected $permission_service;
    public function __construct(
        PermissionService  $permission_service
    ) {
        $this->permission_service = $permission_service;
    }

    public function index()
    {
        abort_if(Gate::denies('permissions_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('permissions.index');
    }


    public function getData(Request $request)
    {
        abort_if(Gate::denies('permissions_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->permission_service->getPermissionSource();
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permissions_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'max:50', 'string', 'unique:permissions,name,' . $request->id]
        ]);

        if ($validation->fails()) {
            $validation_error = "";
            foreach ($validation->errors()->all() as $message) {
                $validation_error .= $message;
            }
            return $this->validationResponse(
                $validation_error
            );
        }
        // try {
        $obj = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = $this->permission_service->save($obj);
        return  $this->success(
            $response,
            ResponseMessage::SAVE,
            true
        );
        // } catch (Exception $e) {
        //     return $this->error(ResponseMessage::ERROR);
        // }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('permissions_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return  $this->success(
                $this->permission_service->getById($id),
                ResponseMessage::SUCCESS,
                false
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}

    public function status($id) {}
}
