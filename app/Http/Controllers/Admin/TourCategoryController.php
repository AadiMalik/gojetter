<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Concrete\TourCategoryService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TourCategoryController extends Controller
{
    use ResponseAPI;
    protected $tour_category_service;

    public function __construct(TourCategoryService $tour_category_service)
    {
        $this->tour_category_service = $tour_category_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('tour_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tour_category.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('tour_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->tour_category_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('tour_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tour_category.create');
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('tour_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|unique:tour_categories,name,' . ($request->id ?? 'null') . ',id',
                'thumbnail' => 'nullable|image',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('thumbnail')) {
                $obj['thumbnail'] = $request->file('thumbnail')->store('tour_category', 'public');
            }

            $response = $this->tour_category_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('tour-category')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('tour_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour_category = $this->tour_category_service->getById($id);
        return view('tour_category.create', compact('tour_category'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('tour_category_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_category = $this->tour_category_service->statusById($id);
            return $this->success(
                $tour_category,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('tour_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_category = $this->tour_category_service->deleteById($id);
            return $this->success(
                $tour_category,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
