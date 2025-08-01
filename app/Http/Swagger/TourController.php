<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class TourController extends Controller
{

      /**
       * @OA\Get(
       *     path="/api/tour-category-list",
       *     tags={"Tour"},
       *     summary="Get list of active tour categories",
       *     description="Returns a list of active tour categories with thumbnail URLs",
       *     operationId="getTourCategoryList",
       *
       *     @OA\Response(
       *         response=200,
       *         description="Successful response",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(
       *                 property="Data",
       *                 type="array",
       *                 @OA\Items(
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Adventure"),
       *                     @OA\Property(property="thumbnail", type="string", example="tour_category/DpLGO0CO1yHcH2kdIBYmOaMCgmTD0lhj5h4CLHDX.webp"),
       *                     @OA\Property(property="is_active", type="integer", example=1),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-18T18:16:30.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T18:16:30.000000Z"),
       *                     @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/tour_category/DpLGO0CO1yHcH2kdIBYmOaMCgmTD0lhj5h4CLHDX.webp")
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function tourCategory() {}

      /**
       * @OA\Get(
       *     path="/api/tour-list",
       *     tags={"Tour"},
       *     summary="Get list of active tours or activities",
       *     description="Returns a list of active tours or activities filtered by search, category_id, type, and sorted by price if specified.",
       *     operationId="getTourList",
       *
       *     @OA\Parameter(
       *         name="type",
       *         in="query",
       *         description="Filter results by type: Tour or Activity",
       *         required=false,
       *         @OA\Schema(type="string", enum={"Tour", "Activity"})
       *     ),
       *     @OA\Parameter(
       *         name="search",
       *         in="query",
       *         description="Search keyword for tour title or description",
       *         required=false,
       *         @OA\Schema(type="string", maxLength=255)
       *     ),
       *     @OA\Parameter(
       *         name="category_id",
       *         in="query",
       *         description="Filter tours by category ID",
       *         required=false,
       *         @OA\Schema(type="integer")
       *     ),
       *     @OA\Parameter(
       *         name="sort_by",
       *         in="query",
       *         description="Sort by price_low_high or price_high_low",
       *         required=false,
       *         @OA\Schema(type="string", enum={"price_low_high", "price_high_low"}, maxLength=255)
       *     ),
       *
       *     @OA\Response(
       *         response=200,
       *         description="Successful response",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(
       *                 property="Data",
       *                 type="array",
       *                 @OA\Items(
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="title", type="string", example="Dubai and Cairo Combo Tour"),
       *                     @OA\Property(property="slug", type="string", example="dubai-and-cairo-combo-tour"),
       *                     @OA\Property(property="thumbnail", type="string", example="tours/sample.png"),
       *                     @OA\Property(property="thumbnail_url", type="string", example="http://localhost/storage/tours/sample.png"),
       *                     @OA\Property(property="overview", type="string", example="<h2 class='st-heading-section'>About this tour</h2>"),
       *                     @OA\Property(property="short_description", type="string", nullable=true),
       *                     @OA\Property(property="full_description", type="string", nullable=true),
       *                     @OA\Property(property="duration_days", type="integer", example=13),
       *                     @OA\Property(property="duration_nights", type="integer", example=12),
       *                     @OA\Property(property="tour_type", type="string", example="Adventure"),
       *                     @OA\Property(property="group_size", type="integer", example=72),
       *                     @OA\Property(property="languages", type="string", example="English, Arabic"),
       *                     @OA\Property(property="price", type="string", example="1898.00"),
       *                     @OA\Property(property="min_adults", type="integer", example=2),
       *                     @OA\Property(property="location", type="string", example="Dubai"),
       *                     @OA\Property(property="is_active", type="integer", example=1),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-08T22:49:38.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T18:16:49.000000Z"),
       *                     @OA\Property(property="tour_category_id", type="integer", example=1),
       *                     @OA\Property(property="average_rating", type="number", format="float", nullable=true, example=4.5),
       *                     @OA\Property(
       *                         property="tour_category",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="name", type="string", example="Adventure"),
       *                         @OA\Property(property="thumbnail", type="string", example="tour_category/sample.webp"),
       *                         @OA\Property(property="thumbnail_url", type="string", example="http://localhost/storage/tour_category/sample.webp"),
       *                         @OA\Property(property="is_active", type="integer", example=1),
       *                         @OA\Property(property="created_at", type="string", format="date-time"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time")
       *                     )
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function tourList() {}

      /**
       * @OA\Get(
       *     path="/api/tour-by-slug/{slug}",
       *     tags={"Tour"},
       *     summary="Get tour detail by slug",
       *     description="Returns a single tour detail with category, reviews, images, and rating",
       *     operationId="getTourBySlug",
       *
       *     @OA\Parameter(
       *         name="slug",
       *         in="path",
       *         description="Tour slug",
       *         required=true,
       *         @OA\Schema(type="string", example="dubai-and-cairo-combo-tour")
       *     ),
       *
       *     @OA\Response(
       *         response=200,
       *         description="Successful response",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(
       *                 property="Data",
       *                 type="object",
       *                 @OA\Property(property="id", type="integer", example=1),
       *                 @OA\Property(property="title", type="string", example="Dubai and Cairo Combo Tour"),
       *                 @OA\Property(property="slug", type="string", example="dubai-and-cairo-combo-tour"),
       *                 @OA\Property(property="thumbnail", type="string", example="tours/image.png"),
       *                 @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/tours/image.png"),
       *                 @OA\Property(property="overview", type="string", example="<h2>About this tour</h2>"),
       *                 @OA\Property(property="short_description", type="string", nullable=true),
       *                 @OA\Property(property="full_description", type="string", nullable=true),
       *                 @OA\Property(property="duration_days", type="integer", example=13),
       *                 @OA\Property(property="duration_nights", type="integer", example=12),
       *                 @OA\Property(property="tour_type", type="string", example="Adventure"),
       *                 @OA\Property(property="group_size", type="integer", example=72),
       *                 @OA\Property(property="languages", type="string", example="English, Arabic"),
       *                 @OA\Property(property="price", type="string", example="1898.00"),
       *                 @OA\Property(property="min_adults", type="integer", example=2),
       *                 @OA\Property(property="location", type="string", example="Dubai"),
       *                 @OA\Property(property="is_active", type="integer", example=1),
       *                 @OA\Property(property="created_at", type="string", format="date-time"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time"),
       *                 @OA\Property(property="tour_category_id", type="integer", example=1),
       *                 @OA\Property(property="average_rating", type="number", format="float", nullable=true, example=4.3),

       *                 @OA\Property(
       *                     property="tour_category",
       *                     type="object",
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Adventure"),
       *                     @OA\Property(property="thumbnail", type="string", example="tour_category/image.webp"),
       *                     @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/tour_category/image.webp"),
       *                     @OA\Property(property="is_active", type="integer", example=1),
       *                     @OA\Property(property="created_at", type="string", format="date-time"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time")
       *                 ),

       *                 @OA\Property(
       *                     property="tour_reviews",
       *                     type="array",
       *                     @OA\Items(
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="user_id", type="integer", example=5),
       *                         @OA\Property(property="rating", type="number", format="float", example=4.5),
       *                         @OA\Property(property="comment", type="string", example="Amazing tour experience!"),
       *                         @OA\Property(property="created_at", type="string", format="date-time")
       *                     )
       *                 ),

       *                 @OA\Property(
       *                     property="tour_images",
       *                     type="array",
       *                     @OA\Items(
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="name", type="string", example="Main Image"),
       *                         @OA\Property(property="image", type="string", example="tour_images/sample.jpg"),
       *                         @OA\Property(property="full_url", type="string", example="http://localhost/gojetter/storage/app/public/tour_images/sample.jpg")
       *                     )
       *                 )
       *             )
       *         )
       *     ),

       *     @OA\Response(
       *         response=404,
       *         description="Tour not found",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Tour not found"),
       *             @OA\Property(property="Success", type="boolean", example=false),
       *             @OA\Property(property="Status", type="integer", example=404)
       *         )
       *     )
       * )
       */
      public function tourBySlug() {}

      /**
       * @OA\Post(
       *     path="/api/save-tour-review",
       *     summary="Submit a review for a tour",
       *     tags={"Tour Review"},
       *     security={{"bearerAuth":{}}},
       *     @OA\RequestBody(
       *         required=true,
       *         @OA\JsonContent(
       *             required={"tour_id", "rating", "comment"},
       *             @OA\Property(property="tour_id", type="integer", example=1),
       *             @OA\Property(property="rating", type="number", format="float", example=5),
       *             @OA\Property(property="comment", type="string", example="good")
       *         )
       *     ),
       *     @OA\Response(
       *         response=200,
       *         description="Review successfully saved",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(
       *                 property="Data",
       *                 type="object",
       *                 @OA\Property(property="id", type="integer", example=2),
       *                 @OA\Property(property="tour_id", type="string", example="1"),
       *                 @OA\Property(property="rating", type="string", example="5"),
       *                 @OA\Property(property="comment", type="string", example="good"),
       *                 @OA\Property(property="user_id", type="integer", example=2),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-18T19:05:53.000000Z"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T19:05:53.000000Z")
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     ),
       *     @OA\Response(
       *         response=422,
       *         description="Validation failed",
       *         @OA\JsonContent(
       *             @OA\Property(property="message", type="string", example="The given data was invalid."),
       *             @OA\Property(property="errors", type="object")
       *         )
       *     )
       * )
       */
      public function storeReiew() {}
}
