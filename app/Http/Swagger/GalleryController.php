<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
      /**
       * @OA\Get(
       *     path="/api/gallery-list",
       *     summary="Get gallery list",
       *     tags={"Gallery"},
       *     @OA\Response(
       *         response=200,
       *         description="Records retrieved successfully.",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(
       *                 property="Data",
       *                 type="array",
       *                 @OA\Items(
       *                     @OA\Property(property="id", type="integer", example=2),
       *                     @OA\Property(property="name", type="string", example="testing"),
       *                     @OA\Property(property="image", type="string", example="tours/OkJ9qWCSM9ps8vhfS4nJsIGcUgfGNWdHziEgsdVG.png"),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-18T20:47:43.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-18T20:47:43.000000Z"),
       *                     @OA\Property(property="image_url", type="string", example="http://localhost/gojetter/storage/app/public/tours/OkJ9qWCSM9ps8vhfS4nJsIGcUgfGNWdHziEgsdVG.png")
       *                 )
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     )
       * )
       */
      public function index() {}
}
