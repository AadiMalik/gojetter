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
        return view('tours.create', compact('tour_category'));
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('tour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'title'             => 'required|string|max:255',
                'slug'              => 'required|string|unique:tours,slug,' . ($request->id ?? 'null') . ',id',
                'tour_category_id'  => 'required',
                'tags'              => 'required|string|max:255',
                'thumbnail'         => 'nullable|image',
                'overview'          => 'nullable|string',
                'short_description' => 'nullable|string',
                'full_description'  => 'nullable|string',
                'highlights'        => 'nullable|string',
                'duration'          => 'nullable|string',
                'tour_type'         => 'nullable|string|in:private,group',
                'group_size'        => 'nullable|integer|min:1',
                'languages'         => 'nullable|string',
                'is_featured'       => 'nullable',
                'location'          => 'nullable|string|max:255',
                'difficulty_level'  => 'nullable|string|in:easy,moderate,challenging,hard,expert',
                'age_limit'         => 'nullable',
                'pickup_info'       => 'nullable|string|max:255',
                'dropoff_info'      => 'nullable|string|max:255',
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
            $obj['is_featured'] = isset($request->is_featured) ? 1 : 0;

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
        return view('tours.create', compact('tour_category', 'tour'));
    }
    public function additional($id)
    {
        // abort_if(Gate::denies('tour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour_category = $this->tour_category_service->getAllActive();
        $tour = $this->tour_service->getById($id);
        return view('tours.additional', compact('tour_category', 'tour'));
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

    //tour date
    public function tourDate(Request $request)
    {
        // abort_if(Gate::denies('tour_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_service->getSourceTourDate($request->all());
    }
    public function tourDateStore(Request $request)
    {
        // abort_if(Gate::denies('tour_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'tour_id' => 'required',
                'start_date' => 'required|date|before:end_date',
                'end_date' => 'required|date|after:start_date',
                'price_type' => 'nullable|in:per_person,per_group',
                'price' => 'required|min:1',
                'discount_price' => 'required|min:0',
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

            $response = $this->tour_service->saveTourDate($obj);

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
    public function tourDateDestroy($id)
    {
        // abort_if(Gate::denies('tour_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_date = $this->tour_service->deleteTourDateById($id);
            return $this->success(
                $tour_date,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    //tour itinerary
    public function tourItinerary(Request $request)
    {
        // abort_if(Gate::denies('tour_itinerary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_service->getSourceTourItinerary($request->all());
    }
    public function tourItineraryStore(Request $request)
    {
        // abort_if(Gate::denies('tour_itinerary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'tour_id' => 'required',
                'day_number' => 'required|integer|min:1',
                'title' => 'required|string|max:255',
                'image' => 'nullable',
                'description' => 'required'
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
            $response = $this->tour_service->saveTourItinerary($obj);

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
    public function tourItineraryDestroy($id)
    {
        // abort_if(Gate::denies('tour_itinerary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_itinerary = $this->tour_service->deleteTourItineraryById($id);
            return $this->success(
                $tour_itinerary,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
