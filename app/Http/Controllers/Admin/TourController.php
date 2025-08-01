<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourCategoryService;
use App\Services\Concrete\TourService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    use ResponseAPI;
    protected $tour_category_service;
    protected $tour_service;

    public function __construct(
        TourCategoryService $tour_category_service,
        TourService $tour_service
    ) {
        $this->tour_category_service = $tour_category_service;
        $this->tour_service = $tour_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('tour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tours.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('tour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->tour_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('tour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour_category = $this->tour_category_service->getAllActive();
        return view('tours.create',compact('tour_category'));
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('tour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'slug' => 'required|string|unique:tours,slug,' . ($request->id ?? 'null') . ',id',
                'tour_category_id' => 'required',
                'thumbnail' => 'nullable|image',
                'overview' => 'nullable|string',
                'short_description' => 'nullable|string',
                'full_description' => 'nullable|string',
                'duration' => 'nullable|string',
                'tour_type' => 'nullable|string|in:Tour,Activity',
                'group_size' => 'nullable|integer|min:1',
                'languages' => 'nullable|string',
                'adult_price' => 'nullable|numeric|min:0',
                'min_adults' => 'nullable|integer|min:0',
                'location' => 'nullable|string|max:255',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('thumbnail')) {
                $obj['thumbnail'] = $request->file('thumbnail')->store('tours', 'public');
            }

            $response = $this->tour_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('tours')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('tour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour_category = $this->tour_category_service->getAllActive();
        $tour = $this->tour_service->getById($id);
        return view('tours.create', compact('tour_category','tour'));
    }

    public function view($id)
    {
        // abort_if(Gate::denies('tour_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($id);
        return view('tours.view', compact('tour'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('tour_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour = $this->tour_service->statusById($id);
            return $this->success(
                $tour,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('tour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour = $this->tour_service->deleteById($id);
            return $this->success(
                $tour,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
