<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\BlogCategoryService;
use App\Services\Concrete\BlogService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    use ResponseAPI;
    protected $blog_category_service;
    protected $blog_service;

    public function __construct(
        BlogCategoryService $blog_category_service,
        BlogService $blog_service
    ) {
        $this->blog_category_service = $blog_category_service;
        $this->blog_service = $blog_service;
    }

    public function index()
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blogs.index');
    }

    public function getData()
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->blog_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blog_category = $this->blog_category_service->getAllActive();
        return view('blogs.create',compact('blog_category'));
    }
    public function store(Request $request)
    {

        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255',
                'slug' => 'required|string|unique:blogs,slug,' . ($request->id ?? 'null') . ',id',
                'blog_category_id' => 'required',
                'image' => 'nullable|image',
                'short_description' => 'nullable|string',
                'description' => 'nullable|string',
                'author' => 'nullable|string',
                'video_url' => 'nullable|string'
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            if ($request->hasFile('image')) {
                $obj['image'] = $request->file('image')->store('blogs', 'public');
            }

            $response = $this->blog_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('blogs')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blog_category = $this->blog_category_service->getAllActive();
        $blog = $this->blog_service->getById($id);
        return view('blogs.create', compact('blog_category','blog'));
    }

    public function view($id)
    {
        abort_if(Gate::denies('blog_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blog = $this->blog_service->getById($id);
        return view('blogs.view', compact('blog'));
    }

    public function status($id)
    {
        abort_if(Gate::denies('blog_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $blog = $this->blog_service->statusById($id);
            return $this->success(
                $blog,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $blog = $this->blog_service->deleteById($id);
            return $this->success(
                $blog,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
