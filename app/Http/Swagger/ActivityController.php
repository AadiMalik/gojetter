<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class ActivityController extends Controller
{

      /**
       * @OA\Get(
       *     path="/api/activity-list",
       *     tags={"Activity"},
       *     summary="Get list of active activities",
       *     description="Returns a list of active activities filtered by search, category_id, type, location, duration, and sorted by price if specified.",
       *     operationId="getActivityList",
       *
       *     @OA\Parameter(
       *         name="type",
       *         in="query",
       *         description="Filter results by type: private or group",
       *         required=false,
       *         @OA\Schema(type="string", enum={"private", "group"})
       *     ),
       *     @OA\Parameter(
       *         name="search",
       *         in="query",
       *         description="Search keyword for activity title or description",
       *         required=false,
       *         @OA\Schema(type="string", maxLength=255)
       *     ),
       *     @OA\Parameter(
       *         name="category_id",
       *         in="query",
       *         description="Filter activities by category ID",
       *         required=false,
       *         @OA\Schema(type="integer")
       *     ),
       *     @OA\Parameter(
       *         name="location",
       *         in="query",
       *         description="Filter activities by location name",
       *         required=false,
       *         @OA\Schema(type="string")
       *     ),
       *     @OA\Parameter(
       *         name="duration",
       *         in="query",
       *         description="Filter activities by duration (e.g., '2 hours', '1 day')",
       *         required=false,
       *         @OA\Schema(type="string")
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
       *                     @OA\Property(property="title", type="string"),
       *                     @OA\Property(property="slug", type="string"),
       *                     @OA\Property(property="thumbnail", type="string"),
       *                     @OA\Property(property="thumbnail_url", type="string"),
       *                     @OA\Property(property="overview", type="string"),
       *                     @OA\Property(property="short_description", type="string", nullable=true),
       *                     @OA\Property(property="highlights", type="string", nullable=true),
       *                     @OA\Property(property="full_description", type="string", nullable=true),
       *                     @OA\Property(property="tags", type="string", nullable=true),
       *                     @OA\Property(property="category_id", type="integer"),
       *                     @OA\Property(property="is_featured", type="integer"),
       *                     @OA\Property(property="difficulty_level", type="string"),
       *                     @OA\Property(property="age_limit", type="integer"),
       *                     @OA\Property(property="pickup_info", type="string"),
       *                     @OA\Property(property="dropoff_info", type="string"),
       *                     @OA\Property(property="location", type="string"),
       *                     @OA\Property(property="duration", type="string"),
       *                     @OA\Property(property="languages", type="string"),
       *                     @OA\Property(property="min_adults", type="integer", nullable=true),
       *                     @OA\Property(property="group_size", type="integer"),
       *                     @OA\Property(property="activity_type", type="string", example="private"),
       *                     @OA\Property(property="is_wheelchair_accessible", type="integer"),
       *                     @OA\Property(property="is_stroller_friendly", type="integer"),
       *                     @OA\Property(property="cut_of_day", type="integer"),
       *                     @OA\Property(property="rules", type="string"),
       *                     @OA\Property(property="requirements", type="string"),
       *                     @OA\Property(property="disclaimers", type="string"),
       *                     @OA\Property(property="is_active", type="integer"),
       *                     @OA\Property(property="created_at", type="string", format="date-time"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time"),
       *                     @OA\Property(property="average_rating", type="number", format="float", nullable=true),
       *
       *                     @OA\Property(
       *                         property="activity_category",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer"),
       *                         @OA\Property(property="name", type="string"),
       *                         @OA\Property(property="thumbnail", type="string"),
       *                         @OA\Property(property="thumbnail_url", type="string"),
       *                         @OA\Property(property="is_active", type="integer"),
       *                         @OA\Property(property="created_at", type="string", format="date-time"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time")
       *                     ),
       *
       *                     @OA\Property(
       *                         property="activity_image",
       *                         type="array",
       *                         @OA\Items(type="object")
       *                     ),
       *
       *                     @OA\Property(
       *                         property="activity_date",
       *                         type="array",
       *                         @OA\Items(
       *                             @OA\Property(property="id", type="integer"),
       *                             @OA\Property(property="activity_id", type="integer"),
       *                             @OA\Property(property="date", type="string", format="date"),
       *                             @OA\Property(property="price", type="string"),
       *                             @OA\Property(property="discount_price", type="string"),
       *                             @OA\Property(property="created_at", type="string", format="date-time"),
       *                             @OA\Property(property="updated_at", type="string", format="date-time"),
       *                             @OA\Property(
       *                                 property="activity_time_slot",
       *                                 type="array",
       *                                 @OA\Items(
       *                                     @OA\Property(property="id", type="integer"),
       *                                     @OA\Property(property="activity_date_id", type="integer"),
       *                                     @OA\Property(property="start_time", type="string"),
       *                                     @OA\Property(property="end_time", type="string"),
       *                                     @OA\Property(property="total_seats", type="integer"),
       *                                     @OA\Property(property="available_seats", type="integer"),
       *                                     @OA\Property(property="created_at", type="string", format="date-time"),
       *                                     @OA\Property(property="updated_at", type="string", format="date-time")
       *                                 )
       *                             )
       *                         )
       *                     ),
       *
       *                     @OA\Property(property="activity_expectation", type="array", @OA\Items(type="object")),
       *                     @OA\Property(property="activity_exclusion", type="array", @OA\Items(type="object")),
       *                     @OA\Property(property="activity_policy", type="array", @OA\Items(type="object")),
       *                     @OA\Property(property="activity_inclusion", type="array", @OA\Items(type="object")),
       *                     @OA\Property(property="activity_reviews", type="array", @OA\Items(type="object"))
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function activityList() {}

      /**
       * @OA\Get(
       *     path="/api/activity-by-slug/{slug}",
       *     tags={"Activity"},
       *     summary="Get activity details by slug",
       *     description="Returns detailed information for a specific activity including category, images, dates, time slots, inclusions, exclusions, policies, expectations, and reviews.",
       *     operationId="getActivityBySlug",
       *
       *     @OA\Parameter(
       *         name="slug",
       *         in="path",
       *         required=true,
       *         description="The unique slug of the activity",
       *         @OA\Schema(type="string", example="aut-et-elit-dolore")
       *     ),
       *
       *     @OA\Response(
       *         response=200,
       *         description="Successful operation",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Data", type="object",
       *                 @OA\Property(property="id", type="integer", example=1),
       *                 @OA\Property(property="title", type="string", example="Aut et elit dolore"),
       *                 @OA\Property(property="slug", type="string", example="aut-et-elit-dolore"),
       *                 @OA\Property(property="thumbnail", type="string", example="activity/OvPJUSSQUToALhK2K2LPlz6degzlFzVdpUhqMtTV.png"),
       *                 @OA\Property(property="overview", type="string", example="Dolor aut nesciunt"),
       *                 @OA\Property(property="short_description", type="string", example="Sint quo est except"),
       *                 @OA\Property(property="highlights", type="string", example="Sed quidem perspicia"),
       *                 @OA\Property(property="full_description", type="string", example="Vero voluptates null"),
       *                 @OA\Property(property="tags", type="string", example="Est ad dolorem bland"),
       *                 @OA\Property(property="category_id", type="integer", example=1),
       *                 @OA\Property(property="is_featured", type="integer", example=1),
       *                 @OA\Property(property="difficulty_level", type="string", example="moderate"),
       *                 @OA\Property(property="age_limit", type="integer", example=43),
       *                 @OA\Property(property="pickup_info", type="string", example="Totam consectetur de"),
       *                 @OA\Property(property="dropoff_info", type="string", example="Tempor error nemo eu"),
       *                 @OA\Property(property="location", type="string", example="Molestiae amet expe"),
       *                 @OA\Property(property="duration", type="string", example="Tenetur natus minim"),
       *                 @OA\Property(property="languages", type="string", example="Aperiam excepturi ad"),
       *                 @OA\Property(property="min_adults", type="integer", nullable=true, example=null),
       *                 @OA\Property(property="group_size", type="integer", example=48),
       *                 @OA\Property(property="activity_type", type="string", example="private"),
       *                 @OA\Property(property="is_wheelchair_accessible", type="integer", example=1),
       *                 @OA\Property(property="is_stroller_friendly", type="integer", example=0),
       *                 @OA\Property(property="cut_of_day", type="integer", example=7),
       *                 @OA\Property(property="rules", type="string", example="Est est ducimus un"),
       *                 @OA\Property(property="requirements", type="string", example="Quas labore ut aute"),
       *                 @OA\Property(property="disclaimers", type="string", example="Dignissimos neque er"),
       *                 @OA\Property(property="is_active", type="integer", example=1),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T17:41:02.000000Z"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T17:41:02.000000Z"),
       *                 @OA\Property(property="average_rating", type="number", nullable=true, example=null),
       *                 @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/activity/OvPJUSSQUToALhK2K2LPlz6degzlFzVdpUhqMtTV.png"),
       *
       *                 @OA\Property(property="activity_category", type="object",
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Advanture"),
       *                     @OA\Property(property="thumbnail", type="string", example="tour_category/DpLGO0CO1yHcH2kdIBYmOaMCgmTD0lhj5h4CLHDX.webp"),
       *                     @OA\Property(property="is_active", type="integer", example=1),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-18T18:16:30.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T18:16:30.000000Z"),
       *                     @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/tour_category/DpLGO0CO1yHcH2kdIBYmOaMCgmTD0lhj5h4CLHDX.webp")
       *                 ),
       *
       *                 @OA\Property(property="activity_reviews", type="array", @OA\Items(type="object")),
       *                 @OA\Property(property="activity_image", type="array", @OA\Items(type="object")),
       *
       *                 @OA\Property(property="activity_date", type="array",
       *                     @OA\Items(
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="activity_id", type="integer", example=1),
       *                         @OA\Property(property="date", type="string", format="date", example="2025-08-11"),
       *                         @OA\Property(property="price", type="string", example="30.00"),
       *                         @OA\Property(property="discount_price", type="string", example="0.00"),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T20:12:09.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T20:12:09.000000Z"),
       *                         @OA\Property(property="activity_time_slot", type="array",
       *                             @OA\Items(
       *                                 @OA\Property(property="id", type="integer", example=2),
       *                                 @OA\Property(property="activity_date_id", type="integer", example=1),
       *                                 @OA\Property(property="start_time", type="string", example="01 AM"),
       *                                 @OA\Property(property="end_time", type="string", example="02 AM"),
       *                                 @OA\Property(property="total_seats", type="integer", example=12),
       *                                 @OA\Property(property="available_seats", type="integer", example=12),
       *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T20:23:09.000000Z"),
       *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T20:23:09.000000Z")
       *                             )
       *                         )
       *                     )
       *                 ),
       *
       *                 @OA\Property(property="activity_expectation", type="array", @OA\Items(type="object")),
       *                 @OA\Property(property="activity_exclusion", type="array", @OA\Items(type="object")),
       *                 @OA\Property(property="activity_policy", type="array", @OA\Items(type="object")),
       *                 @OA\Property(property="activity_inclusion", type="array", @OA\Items(type="object"))
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     ),
       *
       *     @OA\Response(
       *         response=404,
       *         description="Activity not found",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Activity not found."),
       *             @OA\Property(property="Success", type="boolean", example=false),
       *             @OA\Property(property="Status", type="integer", example=404)
       *         )
       *     )
       * )
       */
      public function activityBySlug() {}

      /**
       * @OA\Post(
       *     path="/api/save-activity-review",
       *     summary="Submit a review for a activity",
       *     tags={"Review"},
       *     security={{"bearerAuth":{}}},
       *     @OA\RequestBody(
       *         required=true,
       *         @OA\JsonContent(
       *             required={"activity_id", "rating", "comment"},
       *             @OA\Property(property="activity_id", type="integer", example=1),
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
       *                 @OA\Property(property="activity_id", type="string", example="1"),
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
