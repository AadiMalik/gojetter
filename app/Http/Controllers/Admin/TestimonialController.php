<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Concrete\TestimonialService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TestimonialController extends Controller
{
    use ResponseAPI;
    protected $testimonial_service;

    public function __construct(TestimonialService $testimonial_service)
    {
        $this->testimonial_service = $testimonial_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('testimonial.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->testimonial_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('testimonial.create');
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'profession' => 'required|string',
                'image' => 'nullable|image',
                'message' => 'required|string',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('image')) {
                $obj['image'] = $request->file('image')->store('testimonial', 'public');
            }

            $response = $this->testimonial_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('testimonial')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $testimonial = $this->testimonial_service->getById($id);
        return view('testimonial.create', compact('testimonial'));
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('testimonial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $testimonial = $this->testimonial_service->deleteById($id);
            return $this->success(
                $testimonial,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }


    //api
    public function list(){
        $testimonials = $this->testimonial_service->getAll();
            return $this->success(
                $testimonials,
                ResponseMessage::FETCHED,
                true
            );
    }
}
