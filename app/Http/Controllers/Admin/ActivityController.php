<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ActivityService;
use App\Services\Concrete\DestinationService;
use App\Services\Concrete\TourCategoryService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityController extends Controller
{
    use ResponseAPI;
    protected $activity_category_service;
    protected $activity_service;
    protected $destination_service;

    public function __construct(
        TourCategoryService $activity_category_service,
        ActivityService $activity_service,
        DestinationService $destination_service
    ) {
        $this->activity_category_service = $activity_category_service;
        $this->activity_service = $activity_service;
        $this->destination_service = $destination_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('activity.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->activity_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity_category = $this->activity_category_service->getAllActive();
        $destinations = $this->destination_service->getAllActive();
        return view('activity.create', compact('activity_category','destinations'));
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'title'             => 'required|string|max:255',
                'slug'              => 'required|string|unique:activities,slug,' . ($request->id ?? 'null') . ',id',
                'category_id'       => 'required',
                'tags'              => 'required|string|max:255',
                'thumbnail'         => 'nullable|image',
                'overview'          => 'nullable|string',
                'short_description' => 'nullable|string',
                'full_description'  => 'nullable|string',
                'destination_id'    => 'required',
                'highlights'        => 'nullable|string',
                'rules'             => 'nullable|string',
                'requirements'      => 'nullable|string',
                'disclaimers'       => 'nullable|string',
                'duration'          => 'nullable|string',
                'activity_type'     => 'nullable|string|in:private,group',
                'group_size'        => 'nullable|integer|min:1',
                'languages'         => 'nullable|string',
                'is_featured'       => 'nullable',
                'location'          => 'nullable|string|max:255',
                'difficulty_level'  => 'nullable|string|in:easy,moderate,challenging,hard,expert',
                'age_limit'         => 'nullable',
                'pickup_info'       => 'nullable|string|max:255',
                'dropoff_info'      => 'nullable|string|max:255',
                'cut_of_day'        => 'nullable|integer',
                // 'is_wheelchair_accessible'  => 'nullable',
                // 'is_stroller_friendly'      => 'nullable',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        // try {
            $obj = $request->all();

            if ($request->hasFile('thumbnail')) {
                $obj['thumbnail'] = $request->file('thumbnail')->store('activity', 'public');
            }
            $obj['is_featured'] = isset($request->is_featured) ? 1 : 0;
            // $obj['is_wheelchair_accessible'] = isset($request->is_wheelchair_accessible) ? 1 : 0;
            // $obj['is_stroller_friendly'] = isset($request->is_stroller_friendly) ? 1 : 0;

            $response = $this->activity_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('activity')->with('success', ResponseMessage::SAVE);
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error', ResponseMessage::ERROR);
        // }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity_category = $this->activity_category_service->getAllActive();
        $destinations = $this->destination_service->getAllActive();
        $activity = $this->activity_service->getById($id);
        return view('activity.create', compact('activity_category', 'activity','destinations'));
    }

    public function view($id)
    {
        // abort_if(Gate::denies('activity_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity = $this->activity_service->getById($id);
        return view('activity.view', compact('activity'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('activity_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity = $this->activity_service->statusById($id);
            return $this->success(
                $activity,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity = $this->activity_service->deleteById($id);
            return $this->success(
                $activity,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

}
