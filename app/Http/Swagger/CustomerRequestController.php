<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class CustomerRequestController extends Controller
{
      /**
       * @OA\Post(
       *     path="/api/save-customer-request",
       *     summary="Save a new customer request",
       *     description="Stores a customer request for a sub-service, including optional medical details and file upload.",
       *     operationId="saveCustomerRequest",
       *     tags={"Customer Request"},
       *
       *     @OA\RequestBody(
       *         required=true,
       *         @OA\MediaType(
       *             mediaType="multipart/form-data",
       *             @OA\Schema(
       *                 required={"sub_service_id", "name", "phone"},
       *                 @OA\Property(property="sub_service_id", type="integer", example=1),
       *                 @OA\Property(property="name", type="string", example="John Doe"),
       *                 @OA\Property(property="email", type="string", format="email", example="email@gmail.com"),
       *                 @OA\Property(property="phone", type="string", example="1234567"),
       *                 @OA\Property(property="country", type="string", example="Pakistan"),
       *                 @OA\Property(property="city", type="string", example="Lahore"),
       *                 @OA\Property(property="age", type="integer", example=30),
       *                 @OA\Property(property="medical_history", type="string", example="No prior surgeries"),
       *                 @OA\Property(property="gender", type="string", enum={"male", "female", "other"}, example="male"),
       *                 @OA\Property(property="file", type="string", format="binary"),
       *                 @OA\Property(property="specific_date", type="string", format="date", example="2025-07-30")
       *             )
       *         )
       *     ),
       *
       *     @OA\Response(
       *         response=200,
       *         description="Record saved successfully.",
       *         @OA\JsonContent(
       *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(property="Data", type="object",
       *                 @OA\Property(property="id", type="integer", example=1),
       *                 @OA\Property(property="sub_service_id", type="integer", example=1),
       *                 @OA\Property(property="name", type="string", example="John Doe"),
       *                 @OA\Property(property="email", type="string", nullable=true, example="email@gmail.com"),
       *                 @OA\Property(property="phone", type="string", example="1234567"),
       *                 @OA\Property(property="country", type="string", nullable=true, example="Pakistan"),
       *                 @OA\Property(property="city", type="string", nullable=true, example="Lahore"),
       *                 @OA\Property(property="age", type="integer", nullable=true, example=30),
       *                 @OA\Property(property="medical_history", type="string", nullable=true, example="Diabetic"),
       *                 @OA\Property(property="gender", type="string", nullable=true, example="male"),
       *                 @OA\Property(property="file", type="string", nullable=true, example="customer_requests/file.png"),
       *                 @OA\Property(property="specific_date", type="string", format="date", example="2025-07-30"),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-30T10:11:54.000000Z"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-30T10:11:54.000000Z"),
       *                 @OA\Property(property="sub_service", type="object",
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="service_id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Wallace Riddle"),
       *                     @OA\Property(property="slug", type="string", example="wallace-riddle"),
       *                     @OA\Property(property="image", type="string", example="sub_services/image.png"),
       *                     @OA\Property(property="description", type="string", nullable=true),
       *                     @OA\Property(property="has_customer_form", type="integer", example=1),
       *                     @OA\Property(property="is_active", type="integer", example=1),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                     @OA\Property(property="image_url", type="string", example="http://localhost/gojetter/storage/app/public/sub_services/image.png")
       *                 )
       *             )
       *         )
       *     ),
       *
       *     @OA\Response(
       *         response=422,
       *         description="Validation error"
       *     )
       * )
       */
      public function store() {}
}
