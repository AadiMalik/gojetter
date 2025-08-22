<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\BlogCategoryService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class BlogCategoryController extends Controller
{
    use ResponseAPI;
    protected $blog_category_service;

    public function __construct(BlogCategoryService $blog_category_service)
    {
        $this->blog_category_service = $blog_category_service;
    }

    public function index()
    {
        abort_if(Gate::denies('blog_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blog_category.index');
    }

    public function getData()
    {
        abort_if(Gate::denies('blog_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->blog_category_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function store(Request $request)
    {

        abort_if(Gate::denies('blog_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            $validation_error = "";
            foreach ($validation->errors()->all() as $message) {
                $validation_error .= $message;
            }
            return $this->validationResponse(
                $validation_error
            );
        }
        try {
            if (isset($request->id)) {
                $obj = [
                    'id' => $request->id,
                    'name' => $request->name,
                ];
                $response = $this->blog_category_service->update($obj);
                return  $this->success(
                    $response,
                    ResponseMessage::UPDATE,
                    true
                );
            } else {
                $obj = [
                    'name' => $request->name,
                ];
                $response = $this->blog_category_service->save($obj);
                return  $this->success(
                    $response,
                    ResponseMessage::SAVE,
                    true
                );
            }
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('blog_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return  $this->success(
                $this->blog_category_service->getById($id),
                ResponseMessage::SUCCESS,
                false
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function status($id)
    {
        abort_if(Gate::denies('blog_category_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $blog_category = $this->blog_category_service->statusById($id);
            return $this->success(
                $blog_category,
                ResponseMessage::UPDATE_STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('blog_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $blog_category = $this->blog_category_service->deleteById($id);
            return $this->success(
                $blog_category,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
