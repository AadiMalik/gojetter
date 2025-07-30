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
     *         description="OTP sent after successful registration",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="OTP sent successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="user",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=14),
     *                     @OA\Property(property="name", type="string", example="new user"),
     *                     @OA\Property(property="username", type="string", example="user7"),
     *                     @OA\Property(property="email", type="string", example="user7@gmail.com"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-14T12:26:07.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-14T12:26:07.000000Z"),
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
     *                                 @OA\Property(property="model_id", type="integer", example=14),
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
     *     summary="Login user",
     *     tags={"Customer Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"login", "password"},
     *             @OA\Property(property="login", type="string", example="user6@gmail.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="User logged in successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="object",
     *                 @OA\Property(property="id", type="integer", example=13),
     *                 @OA\Property(property="name", type="string", example="new user"),
     *                 @OA\Property(property="email", type="string", example="user6@gmail.com"),
     *                 @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-14T12:40:21.000000Z"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-14T12:21:22.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-14T12:40:21.000000Z"),
     *                 @OA\Property(property="username", type="string", example="user6"),
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
     *                 @OA\Property(property="token", type="string", example="your_jwt_token_here"),
     *                 @OA\Property(property="roles", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=2),
     *                         @OA\Property(property="name", type="string", example="user"),
     *                         @OA\Property(property="guard_name", type="string", example="web"),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-07T13:41:26.000000Z"),
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Email not verified",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Email not verified. OTP has been sent to your email."),
     *             @OA\Property(property="Success", type="boolean", example=false),
     *             @OA\Property(property="Status", type="integer", example=422)
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

    /**
     * @OA\Post(
     *     path="/api/resend-email-otp",
     *     summary="Resend email OTP to an existing user",
     *     tags={"Customer Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="user7@gmail.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP resent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="OTP sent successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error (email required or not found)",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email field is required."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="email", type="array",
     *                     @OA\Items(type="string", example="The selected email is invalid.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function resendEmailOtp() {}

    /**
     * @OA\Post(
     *     path="/api/verify-email-otp",
     *     summary="Verify email OTP for user account activation",
     *     tags={"Customer Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "otp"},
     *             @OA\Property(property="email", type="string", format="email", example="user6@gmail.com"),
     *             @OA\Property(property="otp", type="string", example="123456", description="6-digit OTP sent to email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP verified and email marked as verified",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="OTP verified successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=13),
     *                 @OA\Property(property="name", type="string", example="new user"),
     *                 @OA\Property(property="email", type="string", example="user6@gmail.com"),
     *                 @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-14T12:40:21.000000Z"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-14T12:21:22.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-14T12:40:21.000000Z"),
     *                 @OA\Property(property="username", type="string", example="user6"),
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
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid or expired OTP",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Invalid OTP or email."),
     *             @OA\Property(property="Success", type="boolean", example=false),
     *             @OA\Property(property="Status", type="integer", example=422)
     *         )
     *     )
     * )
     */
    public function verifyEmailOtp() {}

    /**
     * @OA\Post(
     *     path="/api/forget-password",
     *     summary="Send OTP to email for password reset",
     *     tags={"Customer Auth"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 example="user@example.com",
     *                 description="Registered user email"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OTP sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="OTP sent successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="Errors", type="object")
     *         )
     *     )
     * )
     */
    public function forgetPassword() {}

    /**
     * @OA\Post(
     *     path="/api/change-password",
     *     summary="Change password for authenticated customer",
     *     tags={"Customer Auth"},
     *     security={{"authbearer":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"password", "password_confirmation"},
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 minLength=6,
     *                 example="newpassword123",
     *                 description="New password (must be confirmed)"
     *             ),
     *             @OA\Property(
     *                 property="password_confirmation",
     *                 type="string",
     *                 format="password",
     *                 example="newpassword123",
     *                 description="Confirmation of the new password"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Password changed successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="Errors", type="object")
     *         )
     *     )
     * )
     */
    public function changePassword() {}

    /**
     * @OA\Post(
     *     path="/api/update-profile",
     *     summary="Update customer profile",
     *     description="Allows authenticated customers to update their profile information.",
     *     operationId="updateProfile",
     *     tags={"Customer Auth"},
     *     security={{"authbearer":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "phone", "gender", "country_id", "is_show_email_phone", "home_airport"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="phone", type="string", example="03001234567"),
     *             @OA\Property(property="gender", type="string", example="Male"),
     *             @OA\Property(property="country_id", type="integer", example=1),
     *             @OA\Property(property="avatar", type="string", format="binary"),
     *             @OA\Property(property="is_show_email_phone", type="integer", enum={0,1}, example=0),
     *             @OA\Property(property="home_airport", type="string", example="Lahore"),
     *             @OA\Property(property="state", type="string", nullable=true, example="Punjab"),
     *             @OA\Property(property="city", type="string", nullable=true, example="Lahore"),
     *             @OA\Property(property="address", type="string", nullable=true, example="123 Main Street"),
     *             @OA\Property(property="zip_code", type="string", nullable=true, example="54000"),
     *             @OA\Property(property="paypal_email", type="string", nullable=true, example="paypal@example.com"),
     *             @OA\Property(property="alternative_phone", type="string", nullable=true, example="03009998888")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Record updated successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Record updated successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="object",
     *                 @OA\Property(property="id", type="integer", example=13),
     *                 @OA\Property(property="name", type="string", example="new user 6"),
     *                 @OA\Property(property="email", type="string", example="user6@gmail.com"),
     *                 @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-14T17:30:12.000000Z"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-14T12:21:22.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-17T15:21:49.000000Z"),
     *                 @OA\Property(property="username", type="string", example="user6"),
     *                 @OA\Property(property="phone", type="string", example="03000000001"),
     *                 @OA\Property(property="paypal_email", type="string", nullable=true, example=null),
     *                 @OA\Property(property="is_show_email_phone", type="string", example="0"),
     *                 @OA\Property(property="about_yourself", type="string", nullable=true, example=null),
     *                 @OA\Property(property="avatar", type="string", nullable=true, example=null),
     *                 @OA\Property(property="home_airport", type="string", example="lahore"),
     *                 @OA\Property(property="address", type="string", nullable=true, example=null),
     *                 @OA\Property(property="city", type="string", nullable=true, example=null),
     *                 @OA\Property(property="state", type="string", nullable=true, example=null),
     *                 @OA\Property(property="zip_code", type="string", nullable=true, example=null),
     *                 @OA\Property(property="country_id", type="string", example="1"),
     *                 @OA\Property(property="alternative_phone", type="string", nullable=true, example=null),
     *                 @OA\Property(property="gender", type="string", example="Male")
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function updateProfile() {}

    /**
     * @OA\Post(
     *     path="/api/delete-account",
     *     summary="Delete user account",
     *     description="Permanently deletes the authenticated user's account.",
     *     operationId="deleteAccount",
     *     tags={"Customer Auth"},
     *     security={{"authbearer":{}}},
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Account deleted successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Account deleted successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function deleteAccount() {}
}
