<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{

      /**
       * @OA\Get(
       *     path="/api/service-list",
       *     summary="Get list of services",
       *     tags={"Service"},
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
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Ulla Heath"),
       *                     @OA\Property(property="slug", type="string", example="ulla-heath"),
       *                     @OA\Property(property="image", type="string", example="services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png"),
       *                     @OA\Property(property="description", type="string", example="Tempor amet, invento..."),
       *                     @OA\Property(property="has_contact_form", type="boolean", example=true),
       *                     @OA\Property(property="is_active", type="boolean", example=true),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:22:51.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:26.000000Z"),
       *                     @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png")
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function serviceList() {}

      /**
       * @OA\Get(
       *     path="/api/service-by-slug/{slug}",
       *     summary="Get service detail by slug",
       *     tags={"Service"},
       *     @OA\Parameter(
       *         name="slug",
       *         in="path",
       *         required=true,
       *         description="Slug of the service",
       *         @OA\Schema(type="string", example="ulla-heath")
       *     ),
       *     @OA\Response(
       *         response=200,
       *         description="Record details retrieved successfully.",
       *         @OA\JsonContent(
       *             type="object",
       *             @OA\Property(property="Message", type="string", example="Record details retrieved successfully."),
       *             @OA\Property(property="Success", type="boolean", example=true),
       *             @OA\Property(property="Status", type="integer", example=200),
       *             @OA\Property(
       *                 property="Data",
       *                 type="object",
       *                 @OA\Property(property="id", type="integer", example=1),
       *                 @OA\Property(property="name", type="string", example="Ulla Heath"),
       *                 @OA\Property(property="slug", type="string", example="ulla-heath"),
       *                 @OA\Property(property="image", type="string", example="services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png"),
       *                 @OA\Property(property="description", type="string", example="Tempor amet, invento..."),
       *                 @OA\Property(property="has_contact_form", type="boolean", example=true),
       *                 @OA\Property(property="is_active", type="boolean", example=true),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:22:51.000000Z"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:26.000000Z"),
       *                 @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png"),
       *                 @OA\Property(
       *                     property="sub_services",
       *                     type="array",
       *                     @OA\Items(
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="service_id", type="integer", example=1),
       *                         @OA\Property(property="name", type="string", example="Wallace Riddle"),
       *                         @OA\Property(property="slug", type="string", example="wallace-riddle"),
       *                         @OA\Property(property="image", type="string", example="sub_services/estqqXIykGrRIM65BZPzLndEBhEllwx688psr7PR.png"),
       *                         @OA\Property(property="description", type="string", nullable=true, example=null),
       *                         @OA\Property(property="has_customer_form", type="boolean", example=true),
       *                         @OA\Property(property="is_active", type="boolean", example=true),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                         @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/sub_services/estqqXIykGrRIM65BZPzLndEBhEllwx688psr7PR.png")
       *                     )
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function serviceBySlug() {}

      /**
       * @OA\Get(
       *     path="/api/sub-service-list",
       *     summary="Get list of sub-services with parent service info",
       *     tags={"Service"},
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
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="service_id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Wallace Riddle"),
       *                     @OA\Property(property="slug", type="string", example="wallace-riddle"),
       *                     @OA\Property(property="image", type="string", example="sub_services/estqqXIykGrRIM65BZPzLndEBhEllwx688psr7PR.png"),
       *                     @OA\Property(property="description", type="string", nullable=true, example=null),
       *                     @OA\Property(property="has_customer_form", type="boolean", example=true),
       *                     @OA\Property(property="is_active", type="boolean", example=true),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                     @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/sub_services/estqqXIykGrRIM65BZPzLndEBhEllwx688psr7PR.png"),
       *                     @OA\Property(
       *                         property="service",
       *                         type="object",
       *                         @OA\Property(property="id", type="integer", example=1),
       *                         @OA\Property(property="name", type="string", example="Ulla Heath"),
       *                         @OA\Property(property="slug", type="string", example="ulla-heath"),
       *                         @OA\Property(property="image", type="string", example="services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png"),
       *                         @OA\Property(property="description", type="string", example="Tempor amet, invento..."),
       *                         @OA\Property(property="has_contact_form", type="boolean", example=true),
       *                         @OA\Property(property="is_active", type="boolean", example=true),
       *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:22:51.000000Z"),
       *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:26.000000Z"),
       *                         @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png")
       *                     )
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function subServiceList() {}

      /**
       * @OA\Get(
       *     path="/api/sub-service-by-slug/{slug}",
       *     summary="Get sub-service details by slug",
       *     tags={"Service"},
       *     @OA\Parameter(
       *         name="slug",
       *         in="path",
       *         required=true,
       *         description="Slug of the sub-service",
       *         @OA\Schema(type="string", example="wallace-riddle")
       *     ),
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
       *                 type="object",
       *                 @OA\Property(property="id", type="integer", example=1),
       *                 @OA\Property(property="service_id", type="integer", example=1),
       *                 @OA\Property(property="name", type="string", example="Wallace Riddle"),
       *                 @OA\Property(property="slug", type="string", example="wallace-riddle"),
       *                 @OA\Property(property="image", type="string", example="sub_services/estqqXIykGrRIM65BZPzLndEBhEllwx688psr7PR.png"),
       *                 @OA\Property(property="description", type="string", nullable=true, example=null),
       *                 @OA\Property(property="has_customer_form", type="boolean", example=true),
       *                 @OA\Property(property="is_active", type="boolean", example=true),
       *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:18.000000Z"),
       *                 @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/sub_services/estqqXIykGrRIM65BZPzLndEBhEllwx688psr7PR.png"),
       *                 @OA\Property(
       *                     property="service",
       *                     type="object",
       *                     @OA\Property(property="id", type="integer", example=1),
       *                     @OA\Property(property="name", type="string", example="Ulla Heath"),
       *                     @OA\Property(property="slug", type="string", example="ulla-heath"),
       *                     @OA\Property(property="image", type="string", example="services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png"),
       *                     @OA\Property(property="description", type="string", example="Tempor amet, invento..."),
       *                     @OA\Property(property="has_contact_form", type="boolean", example=true),
       *                     @OA\Property(property="is_active", type="boolean", example=true),
       *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-29T22:22:51.000000Z"),
       *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-29T22:59:26.000000Z"),
       *                     @OA\Property(property="image_url", type="string", format="url", example="http://localhost/gojetter/storage/app/public/services/hdqlUEIoEZ0d5Yg1sW0PkSjrYgkG6NkcW7BqOeB8.png")
       *                 )
       *             )
       *         )
       *     )
       * )
       */
      public function subServiceBySlug() {}
}
