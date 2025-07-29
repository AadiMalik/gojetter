<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\Api\BlogService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ResponseAPI;
    protected $blog_service;

    public function __construct(
        BlogService $blog_service
    ) {
        $this->blog_service = $blog_service;
    }

    public function blogCategoryList()
    {
        $blog_categories = $this->blog_service->getBlogCategories();
        return $this->success(
            $blog_categories,
            ResponseMessage::FETCHED
        );
    }

    //blog list
    public function blogList()
    {
        $blogs = $this->blog_service->getBlogs();
        return $this->success(
            $blogs,
            ResponseMessage::FETCHED
        );
    }

    //blog by slug
    public function blogBySlug($slug)
    {
        $blog = $this->blog_service->getBlogBySlug($slug);
        return $this->success(
            $blog,
            ResponseMessage::FETCHED_DETAIL
        );
    }
}
