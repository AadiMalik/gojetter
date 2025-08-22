<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\SocialMediaService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SocialMediaController extends Controller
{
    use ResponseAPI;
    protected $social_media_service;

    public function __construct(SocialMediaService $social_media_service)
    {
        $this->social_media_service = $social_media_service;
    }

    public function index()
    {
        abort_if(Gate::denies('social_media_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('social_media.index');
    }

    public function getData()
    {
        abort_if(Gate::denies('social_media_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->social_media_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        abort_if(Gate::denies('social_media_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('social_media.create');
    }
    public function store(Request $request)
    {

        abort_if(Gate::denies('social_media_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isUpdate = isset($request->id);
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'url' => 'required|string',
                'icon' => ($isUpdate ? 'nullable' : 'required') . '|mimes:svg',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('icon')) {
                $obj['icon'] = $request->file('icon')->store('social_media', 'public');
            }

            $response = $this->social_media_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('social-media')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('social_media_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $social_media = $this->social_media_service->getById($id);
        return view('social_media.create', compact('social_media'));
    }

    public function status($id)
    {
        abort_if(Gate::denies('social_media_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $social_media = $this->social_media_service->statusById($id);
            return $this->success(
                $social_media,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('social_media_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $social_media = $this->social_media_service->deleteById($id);
            return $this->success(
                $social_media,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
