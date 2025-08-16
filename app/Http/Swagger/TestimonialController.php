<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
      /**
       * @OA\Get(
       *     path="/api/testimonial-list",
       *     summary="Get testimonial list",
       *     description="Fetch all active testimonials",
       *     operationId="getTestimonials",
       *     tags={"Testimonial"},
       *
       *     @OA\Response(
       *         response=200,
       *         description="Records retrieved successfully.",
       *         @OA\JsonContent(
       *             type="object",
       *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(
       *                 property="Data",
       *                 type="array",
       *                 @OA\Items(
       *                     type="object",
       *                     @OA\Property(property="id", type="integer", example=2),
       *                     @OA\Property(property="name", type="string", example="Daniel Morgan"),
       *                     @OA\Property(property="image", type="string", example="testimonial/RbXBilEDEnaIvMxE535WORpjNVA2hkdKhYDxaSFR.webp"),
       *                     @OA\Property(property="profession", type="string", example="Manager"),
       *                     @OA\Property(property="message", type="string", example="Exceptional service delivery and innovative solutions have transformed our business operations, leading to remarkable growth and enhanced customer satisfaction across all touchpoints."),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-16T17:23:36.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-16T17:23:36.000000Z"),
       *                     @OA\Property(property="image_url", type="string", example="http://localhost/gojetter/storage/app/public/testimonial/RbXBilEDEnaIvMxE535WORpjNVA2hkdKhYDxaSFR.webp")
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function list() {}
}
