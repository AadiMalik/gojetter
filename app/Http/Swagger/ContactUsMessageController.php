<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class ContactUsMessageController extends Controller
{

      /**
       * @OA\Post(
       *     path="/api/save-contact-us",
       *     tags={"Contact Us"},
       *     summary="Submit a contact us message",
       *     description="Saves a contact form entry from a user.",
       *     operationId="saveContactUs",
       *     @OA\RequestBody(
       *         required=true,
       *         @OA\JsonContent(
       *             required={"name", "email", "phone", "subject", "message"},
       *             @OA\Property(property="name", type="string", maxLength=255, example="Awais Akram"),
       *             @OA\Property(property="email", type="string", format="email", maxLength=255, example="awais@gmail.com"),
       *             @OA\Property(property="phone", type="string", maxLength=255, example="1234567896"),
       *             @OA\Property(property="subject", type="string", maxLength=255, example="For Seo Marketing Contact Me"),
       *             @OA\Property(property="message", type="string", maxLength=500, example="ثم إنه رفع رأسه إلى السماء وقال...")
       *         )
       *     ),
       *     @OA\Response(
       *         response=200,
       *         description="Successful response",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(
       *                 property="Data",
       *                 type="object",
       *                 @OA\Property(property="id", type="integer", example=11),
       *                 @OA\Property(property="name", type="string", example="Awais Akram"),
       *                 @OA\Property(property="email", type="string", example="awais@gmail.com"),
       *                 @OA\Property(property="phone", type="string", example="1234567896"),
       *                 @OA\Property(property="subject", type="string", example="For Seo Marketing Contact Me"),
       *                 @OA\Property(property="message", type="string", example="ثم إنه رفع رأسه إلى السماء وقال..."),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-19T11:17:37.000000Z"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-19T11:17:37.000000Z")
       *             ),
       *             @OA\Property(property="Status", type="integer", example=200)
       *         )
       *     )
       * )
       */
      public function store() {}
}
