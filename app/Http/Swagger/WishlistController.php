<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class WishlistController extends Controller
{

      /**
       * @OA\Get(
       *     path="/api/wishlist-list",
       *     summary="Get wishlist of authenticated user",
       *     tags={"Wishlist"},
       *     security={{"bearerAuth":{}}},
       *     @OA\Response(
       *         response=200,
       *         description="Records retrieved successfully.",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(
       *                 property="Data",
       *                 type="array",
       *                 @OA\Items(
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="tour_id", type="integer", example=1),
       *                     @OA\Property(property="user_id", type="integer", example=2),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-18T21:09:39.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T21:09:39.000000Z"),
       *                     
       *                     @OA\Property(
       *                         property="tour",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="title", type="string", example="Dubai and Cairo Combo Tour"),
       *                         @OA\Property(property="slug", type="string", example="dubai-and-cairo-combo-tour"),
       *                         @OA\Property(property="thumbnail", type="string", example="tours/image.png"),
       *                         @OA\Property(property="overview", type="string", example="<h2>About this tour</h2>..."),
       *                         @OA\Property(property="duration_days", type="integer", example=13),
       *                         @OA\Property(property="duration_nights", type="integer", example=12),
       *                         @OA\Property(property="tour_type", type="string", example="Leisure"),
       *                         @OA\Property(property="group_size", type="integer", example=72),
       *                         @OA\Property(property="languages", type="string", example="English, Arabic"),
       *                         @OA\Property(property="price", type="string", example="1898.00"),
       *                         @OA\Property(property="min_adults", type="integer", example=2),
       *                         @OA\Property(property="location", type="string", example="Dubai, UAE"),
       *                         @OA\Property(property="is_active", type="integer", example=1),
       *                         @OA\Property(property="tour_category_id", type="integer", example=1),
       *                         @OA\Property(property="thumbnail_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/tours/image.png")
       *                     ),
       *                     
       *                     @OA\Property(
       *                         property="user",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=2),
       *                         @OA\Property(property="name", type="string", example="User"),
       *                         @OA\Property(property="email", type="string", example="user@user.com"),
       *                         @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-19T00:04:27.000000Z"),
       *                         @OA\Property(property="is_show_email_phone", type="integer", example=0)
       *                     )
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function index() {}

      /**
       * @OA\Post(
       *     path="/api/save-wishlist",
       *     tags={"Wishlist"},
       *     summary="Add a tour to wishlist",
       *     description="Adds a tour to the authenticated user's wishlist.",
       *     security={{"bearerAuth":{}}},
       *     @OA\RequestBody(
       *         required=true,
       *         @OA\JsonContent(
       *             required={"tour_id"},
       *             @OA\Property(property="tour_id", type="integer", example=1, description="ID of the tour to be added to wishlist")
       *         )
       *     ),
       *     @OA\Response(
       *         response=200,
       *         description="Wishlist entry created successfully",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Data", type="object",
       *                 @OA\Property(property="tour_id", type="string", example="1"),
       *                 @OA\Property(property="user_id", type="integer", example=2),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T21:09:39.000000Z"),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-18T21:09:39.000000Z"),
       *                 @OA\Property(property="id", type="integer", example=1)
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     ),
       *     @OA\Response(
       *         response=422,
       *         description="Validation error"
       *     ),
       *     @OA\Response(
       *         response=401,
       *         description="Unauthorized"
       *     )
       * )
       */
      public function store() {}

      /**
       * @OA\Post(
       *     path="/api/delete-wishlist/{id}",
       *     tags={"Wishlist"},
       *     summary="Delete a wishlist item",
       *     description="Deletes a wishlist item for the authenticated user by ID.",
       *     security={{"bearerAuth":{}}},
       *     @OA\Parameter(
       *         name="id",
       *         in="path",
       *         required=true,
       *         description="ID of the wishlist item to delete",
       *         @OA\Schema(type="integer", example=1)
       *     ),
       *     @OA\Response(
       *         response=200,
       *         description="Wishlist entry deleted successfully",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record deleted successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Data", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     ),
       *     @OA\Response(
       *         response=401,
       *         description="Unauthorized"
       *     ),
       *     @OA\Response(
       *         response=404,
       *         description="Wishlist item not found"
       *     )
       * )
       */
      public function destroy() {}
}
