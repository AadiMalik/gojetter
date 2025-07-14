<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/social-media-list",
     *     summary="Get list of active social media links",
     *     tags={"Social Media"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Records retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Facebook"),
     *                     @OA\Property(property="icon", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/social_media/DmsGSwZthvpfmuQ9IlYvcpoPlI8vy7kraAadk4vB.svg"),
     *                     @OA\Property(property="url", type="string", format="uri", example="https://www.facebook.com/"),
     *                     @OA\Property(property="is_active", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-14T18:39:13.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-14T18:39:13.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function index() {}
}
