<?php

namespace App\Services\Concrete\Api;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BlogService
{
    protected $model_blog;
    protected $model_blog_category;
    public function __construct()
    {
        // set the model
        $this->model_blog = new Repository(new Blog);
        $this->model_blog_category = new Repository(new BlogCategory);
    }

    // get all
    public function getBlogCategories()
    {
        return $this->model_blog_category->getModel()::where('is_deleted', 0)
            ->where('is_active', 1)
            ->get();
    }

    // get all
    public function getBlogs()
    {
        return $this->model_blog->getModel()::with('category')->where('is_deleted', 0)
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getBlogBySlug($slug)
    {
        return $this->model_blog->getModel()::with('category')->where('slug', $slug)->first();
    }
}
