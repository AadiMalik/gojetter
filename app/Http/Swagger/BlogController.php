<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/blog-category-list",
     *     tags={"Blog"},
     *     summary="Get list of blog categories",
     *     description="Returns all blog categories that are not deleted",
     *     operationId="getBlogCategoryList",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Blog Category 1"),
     *                     @OA\Property(property="is_active", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T13:45:15.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T13:45:15.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function blogCategoryList() {}

    /**
     * @OA\Get(
     *     path="/api/blog-list",
     *     tags={"Blog"},
     *     summary="Get list of blogs",
     *     description="Returns all active blogs with related category data",
     *     operationId="getBlogList",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Exploring the Hidden Gems of Northern Pakistan"),
     *                     @OA\Property(property="slug", type="string", example="exploring-the-hidden-gems-of-northern-pakistan"),
     *                     @OA\Property(property="short_description", type="string", example="<p>Discover breathtaking valleys, lakes, and traditions nestled in Pakistan's northern regions.</p>"),
     *                     @OA\Property(property="description", type="string", example="<p>Full blog content here...</p>"),
     *                     @OA\Property(property="image", type="string", example="blogs/Zii5TZq2uewbU9qk4LJAvPGp8blFH7otCYPJvZQH.jpg"),
     *                     @OA\Property(property="video_url", type="string", example="https://www.youtube.com/embed/UnUTQ8d8ppE?si=ZeB6WMBtfQ3pPD2p"),
     *                     @OA\Property(property="blog_category_id", type="integer", example=1),
     *                     @OA\Property(property="author", type="string", example="Sarah Malik"),
     *                     @OA\Property(property="is_active", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T16:12:23.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T16:15:22.000000Z"),
     *                     @OA\Property(property="image_url", type="string", example="http://localhost/gojetter/storage/app/public/blogs/Zii5TZq2uewbU9qk4LJAvPGp8blFH7otCYPJvZQH.jpg"),
     *                     @OA\Property(
     *                         property="category",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Blog Category 1"),
     *                         @OA\Property(property="is_active", type="integer", example=1),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T13:45:15.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T13:45:15.000000Z")
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function blogList() {}

    /**
     * @OA\Get(
     *     path="/api/blog-by-slug/{slug}",
     *     summary="Get blog details by slug",
     *     description="Fetch a blog post along with its category by slug",
     *     operationId="getBlogBySlug",
     *     tags={"Blog"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="The slug of the blog post",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record details retrieved successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Record details retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Exploring the Hidden Gems of Northern Pakistan"),
     *                 @OA\Property(property="slug", type="string", example="exploring-the-hidden-gems-of-northern-pakistan"),
     *                 @OA\Property(property="short_description", type="string", example="<p>Discover breathtaking valleys...</p>"),
     *                 @OA\Property(property="description", type="string", example="<p>The northern areas of Pakistan offer...</p>"),
     *                 @OA\Property(property="image", type="string", example="blogs/Zii5TZq2uewbU9qk4LJAvPGp8blFH7otCYPJvZQH.jpg"),
     *                 @OA\Property(property="video_url", type="string", example="https://www.youtube.com/embed/UnUTQ8d8ppE?si=ZeB6WMBtfQ3pPD2p"),
     *                 @OA\Property(property="blog_category_id", type="integer", example=1),
     *                 @OA\Property(property="author", type="string", example="Sarah Malik"),
     *                 @OA\Property(property="is_active", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T16:12:23.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T16:15:22.000000Z"),
     *                 @OA\Property(property="image_url", type="string", example="http://localhost/gojetter/storage/app/public/blogs/Zii5TZq2uewbU9qk4LJAvPGp8blFH7otCYPJvZQH.jpg"),
     *                 @OA\Property(
     *                     property="category",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Blog Category 1"),
     *                     @OA\Property(property="is_active", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T13:45:15.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T13:45:15.000000Z")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function blogBySlug() {}
}
