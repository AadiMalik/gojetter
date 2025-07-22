<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/apply-coupon",
     *     tags={"Coupon"},
     *     summary="Apply a coupon by code",
     *     operationId="applyCoupon",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"code"},
     *             @OA\Property(property="code", type="string", example="SAMS10", description="Coupon code to apply")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Coupon applied successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Operation completed successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="code", type="string", example="SAMS10"),
     *                 @OA\Property(property="type", type="string", example="amount"),
     *                 @OA\Property(property="value", type="string", example="100.00"),
     *                 @OA\Property(property="valid_from", type="string", format="date", example="2025-07-22"),
     *                 @OA\Property(property="valid_until", type="string", format="date", example="2025-07-30"),
     *                 @OA\Property(property="is_active", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-22T16:42:11.000000Z")
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="code", type="array", @OA\Items(type="string", example="The selected code is invalid."))
     *             )
     *         )
     *     )
     * )
     */
    public function applyCoupon() {}
}
