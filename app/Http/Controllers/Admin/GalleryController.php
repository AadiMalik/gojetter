<?php

namespace App\Http\Controllers\Admin;


use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\GalleryService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class GalleryController extends Controller
{
    use ResponseAPI;
    protected $gallery_service;

    public function __construct(
        GalleryService $gallery_service
    ) {
        $this->gallery_service = $gallery_service;
    }

    public function index()
    {
        abort_if(Gate::denies('gallery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('gallery.index');
    }

    public function getData()
    {
        abort_if(Gate::denies('gallery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->gallery_service->getSource();
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('gallery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'image' => 'nullable|image'
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
            $obj = $request->all();

            if ($request->hasFile('image')) {
                $obj['image'] = $request->file('image')->store('tours', 'public');
            }

            $response = $this->gallery_service->save($obj);

            if (!$response) {
                return $this->error(ResponseMessage::ERROR);
            }

            return  $this->success(
                $response,
                ResponseMessage::SAVE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }


    public function destroy($id)
    {
        abort_if(Gate::denies('gallery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $gallery = $this->gallery_service->deleteById($id);
            return $this->success(
                $gallery,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
