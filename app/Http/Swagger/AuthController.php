<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new customer user",
     *     tags={"Customer Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","username","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="John Doe"),
     *             @OA\Property(property="username", type="string", maxLength=255, example="johndoe", description="No spaces allowed"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", minLength=6, example="secret123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", minLength=6, example="secret123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Registration",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="User registered successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="user",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=3),
     *                     @OA\Property(property="name", type="string", example="new user"),
     *                     @OA\Property(property="email", type="string", example="user1@gmail.com"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-07T14:34:38.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-07T14:34:38.000000Z"),
     *                     @OA\Property(
     *                         property="roles",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=2),
     *                             @OA\Property(property="name", type="string", example="user"),
     *                             @OA\Property(property="guard_name", type="string", example="web"),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                             @OA\Property(
     *                                 property="pivot",
     *                                 type="object",
     *                                 @OA\Property(property="model_id", type="integer", example=3),
     *                                 @OA\Property(property="role_id", type="integer", example=2),
     *                                 @OA\Property(property="model_type", type="string", example="App\\Models\\User")
     *                             )
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(property="token", type="string", nullable=true, example=null)
     *             )
     *         )
     *     )
     * )
     */
    public function signup() {}

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login a customer user",
     *     tags={"Customer Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"login", "password"},
     *             @OA\Property(property="login", type="string", example="user@user.com or username"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Login",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="User logged in successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="name", type="string", example="User"),
     *                 @OA\Property(property="email", type="string", example="user@user.com"),
     *                 @OA\Property(property="email_verified_at", type="string", nullable=true, example=null),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                 @OA\Property(property="username", type="string", example="user"),
     *                 @OA\Property(property="phone", type="string", nullable=true, example=null),
     *                 @OA\Property(property="paypal_email", type="string", nullable=true, example=null),
     *                 @OA\Property(property="is_show_email_phone", type="integer", example=0),
     *                 @OA\Property(property="about_yourself", type="string", nullable=true, example=null),
     *                 @OA\Property(property="avatar", type="string", nullable=true, example=null),
     *                 @OA\Property(property="home_airport", type="string", nullable=true, example=null),
     *                 @OA\Property(property="address", type="string", nullable=true, example=null),
     *                 @OA\Property(property="city", type="string", nullable=true, example=null),
     *                 @OA\Property(property="state", type="string", nullable=true, example=null),
     *                 @OA\Property(property="zip_code", type="string", nullable=true, example=null),
     *                 @OA\Property(property="country", type="string", nullable=true, example=null),
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *                 @OA\Property(
     *                     property="roles",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=2),
     *                         @OA\Property(property="name", type="string", example="user"),
     *                         @OA\Property(property="guard_name", type="string", example="web"),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                         @OA\Property(
     *                             property="pivot",
     *                             type="object",
     *                             @OA\Property(property="model_id", type="integer", example=2),
     *                             @OA\Property(property="role_id", type="integer", example=2),
     *                             @OA\Property(property="model_type", type="string", example="App\\Models\\User")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function login() {}

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout the authenticated customer user",
     *     tags={"Customer Auth"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful Logout",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="User logged out successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="array", @OA\Items(type="string"), example={}),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function logout() {}
}
