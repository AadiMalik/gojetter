<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
      /**
       * @OA\Get(
       *     path="/api/cart-list",
       *     summary="Get cart list",
       *     description="Retrieve the list of cart items for the authenticated user",
       *     tags={"Cart"},
       *     security={{"authbearer":{}}},
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
       *                     @OA\Property(property="user_id", type="integer", example=2),
       *                     @OA\Property(property="activity_id", type="integer", example=1),
       *                     @OA\Property(property="activity_date_id", type="integer", example=1),
       *                     @OA\Property(property="activity_time_slot_id", type="integer", example=2),
       *                     @OA\Property(property="quantity", type="integer", example=1),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T23:32:35.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T23:32:35.000000Z"),
       *                     @OA\Property(
       *                         property="activity",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="title", type="string", example="Aut et elit dolore"),
       *                         @OA\Property(property="slug", type="string", example="aut-et-elit-dolore"),
       *                         @OA\Property(property="thumbnail", type="string", example="activity/OvPJUSSQUToALhK2K2LPlz6degzlFzVdpUhqMtTV.png"),
       *                         @OA\Property(property="overview", type="string", example="Dolor aut nesciunt"),
       *                         @OA\Property(property="short_description", type="string", example="Sint quo est except"),
       *                         @OA\Property(property="highlights", type="string", example="Sed quidem perspicia"),
       *                         @OA\Property(property="full_description", type="string", example="Vero voluptates null"),
       *                         @OA\Property(property="tags", type="string", example="Est ad dolorem bland"),
       *                         @OA\Property(property="category_id", type="integer", example=1),
       *                         @OA\Property(property="is_featured", type="integer", example=1),
       *                         @OA\Property(property="difficulty_level", type="string", example="moderate"),
       *                         @OA\Property(property="age_limit", type="integer", example=43),
       *                         @OA\Property(property="pickup_info", type="string", example="Totam consectetur de"),
       *                         @OA\Property(property="dropoff_info", type="string", example="Tempor error nemo eu"),
       *                         @OA\Property(property="location", type="string", example="Molestiae amet expe"),
       *                         @OA\Property(property="duration", type="string", example="Tenetur natus minim"),
       *                         @OA\Property(property="languages", type="string", example="Aperiam excepturi ad"),
       *                         @OA\Property(property="min_adults", type="integer", nullable=true, example=null),
       *                         @OA\Property(property="group_size", type="integer", example=48),
       *                         @OA\Property(property="activity_type", type="string", example="private"),
       *                         @OA\Property(property="is_wheelchair_accessible", type="integer", example=1),
       *                         @OA\Property(property="is_stroller_friendly", type="integer", example=0),
       *                         @OA\Property(property="cut_of_day", type="integer", example=7),
       *                         @OA\Property(property="rules", type="string", example="Est est ducimus un"),
       *                         @OA\Property(property="requirements", type="string", example="Quas labore ut aute"),
       *                         @OA\Property(property="disclaimers", type="string", example="Dignissimos neque er"),
       *                         @OA\Property(property="is_active", type="integer", example=1),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T17:41:02.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T17:41:02.000000Z"),
       *                         @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/activity/OvPJUSSQUToALhK2K2LPlz6degzlFzVdpUhqMtTV.png")
       *                     ),
       *                     @OA\Property(
       *                         property="activity_date",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="activity_id", type="integer", example=1),
       *                         @OA\Property(property="date", type="string", format="date", example="2025-08-11"),
       *                         @OA\Property(property="price", type="string", example="30.00"),
       *                         @OA\Property(property="discount_price", type="string", example="0.00"),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T20:12:09.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T20:12:09.000000Z")
       *                     ),
       *                     @OA\Property(
       *                         property="activity_time_slot",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=2),
       *                         @OA\Property(property="activity_date_id", type="integer", example=1),
       *                         @OA\Property(property="start_time", type="string", example="01 AM"),
       *                         @OA\Property(property="end_time", type="string", example="02 AM"),
       *                         @OA\Property(property="total_seats", type="integer", example=12),
       *                         @OA\Property(property="available_seats", type="integer", example=12),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T20:23:09.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T20:23:09.000000Z")
       *                     ),
       *                     @OA\Property(
       *                         property="user",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=2),
       *                         @OA\Property(property="name", type="string", example="User"),
       *                         @OA\Property(property="email", type="string", example="user@user.com"),
       *                         @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-19T00:04:27.000000Z"),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-04T09:53:20.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T19:03:39.000000Z"),
       *                         @OA\Property(property="username", type="string", nullable=true, example=null),
       *                         @OA\Property(property="phone", type="string", nullable=true, example=null),
       *                         @OA\Property(property="paypal_email", type="string", nullable=true, example=null),
       *                         @OA\Property(property="is_show_email_phone", type="integer", example=0),
       *                         @OA\Property(property="about_yourself", type="string", nullable=true, example=null),
       *                         @OA\Property(property="avatar", type="string", nullable=true, example=null),
       *                         @OA\Property(property="home_airport", type="string", nullable=true, example=null),
       *                         @OA\Property(property="address", type="string", nullable=true, example=null),
       *                         @OA\Property(property="city", type="string", nullable=true, example=null),
       *                         @OA\Property(property="state", type="string", nullable=true, example=null),
       *                         @OA\Property(property="zip_code", type="string", nullable=true, example=null),
       *                         @OA\Property(property="country_id", type="string", nullable=true, example=null),
       *                         @OA\Property(property="alternative_phone", type="string", nullable=true, example=null),
       *                         @OA\Property(property="gender", type="string", nullable=true, example=null),
       *                         @OA\Property(property="stripe_customer_id", type="string", nullable=true, example=null)
       *                     )
       *                 )
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     )
       * )
       */
      public function index() {}

      /**
       * @OA\Post(
       *     path="/api/save-cart",
       *     tags={"Cart"},
       *     summary="Save a cart item",
       *     description="Stores a new cart item for the authenticated user.",
       *     operationId="saveCart",
       *     security={{"bearerAuth":{}}},
       *
       *     @OA\RequestBody(
       *         required=true,
       *         @OA\JsonContent(
       *             required={"activity_id", "activity_date_id", "activity_time_slot_id", "quantity"},
       *             @OA\Property(property="activity_id", type="integer", example=1, description="ID of the activity (must exist in activities table)"),
       *             @OA\Property(property="activity_date_id", type="integer", example=1, description="ID of the activity date (must exist in activity_dates table)"),
       *             @OA\Property(property="activity_time_slot_id", type="integer", example=2, description="ID of the activity time slot (must exist in activity_time_slots table)"),
       *             @OA\Property(property="quantity", type="integer", example=1, description="Number of seats to book (minimum 1)")
       *         )
       *     ),
       *
       *     @OA\Response(
       *         response=200,
       *         description="Record saved successfully",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(
       *                 property="Data",
       *                 type="object",
       *                 @OA\Property(property="activity_id", type="integer", example=1),
       *                 @OA\Property(property="activity_date_id", type="integer", example=1),
       *                 @OA\Property(property="activity_time_slot_id", type="integer", example=2),
       *                 @OA\Property(property="user_id", type="integer", example=2),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-09T23:32:35.000000Z"),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-09T23:32:35.000000Z"),
       *                 @OA\Property(property="id", type="integer", example=1)
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     ),
       *
       *     @OA\Response(
       *         response=400,
       *         description="Validation error or invalid input"
       *     ),
       *     @OA\Response(
       *         response=401,
       *         description="Unauthorized"
       *     )
       * )
       */
      public function store() {}

      /**
       * @OA\Get(
       *     path="/api/delete-cart/{id}",
       *     tags={"Cart"},
       *     summary="Delete a cart record",
       *     description="Deletes the cart item with the given ID for the authenticated user.",
       *     security={{"authbearer": {}}},
       *     operationId="deleteCart",
       *
       *     @OA\Parameter(
       *         name="id",
       *         in="path",
       *         required=true,
       *         description="ID of the cart record to delete",
       *         @OA\Schema(type="integer", example=1)
       *     ),
       *
       *     @OA\Response(
       *         response=200,
       *         description="Cart record deleted successfully",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record deleted successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Data", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     ),
       *
       *     @OA\Response(
       *         response=404,
       *         description="Cart record not found"
       *     )
       * )
       */
      public function destroy() {}
}
