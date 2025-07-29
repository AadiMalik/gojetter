<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class CustomerCardController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/customer-card-list",
     *     summary="Get customer card list",
     *     description="Retrieve a list of cards saved by the authenticated customer.",
     *     operationId="getCustomerCardList",
     *     tags={"Customer Card"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Records retrieved successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="array", @OA\Items(), example={}),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/save-customer-card",
     *     summary="Save a new customer card",
     *     description="Store a new card for the authenticated customer using a Stripe payment method.",
     *     operationId="saveCustomerCard",
     *     tags={"Customer Card"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"payment_method_id"},
     *             @OA\Property(property="payment_method_id", type="string", example="pm_1NxWy5JvL3RQyoU1slm0HdM2"),
     *             @OA\Property(property="is_default", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer card saved successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="is_default", type="boolean", example=true),
     *             @OA\Property(property="stripe_payment_method_id", type="string", example="pm_1NxWy5JvL3RQyoU1slm0HdM2"),
     *             @OA\Property(property="card_brand", type="string", example="visa"),
     *             @OA\Property(property="card_last_four", type="string", example="4242"),
     *             @OA\Property(property="exp_month", type="integer", example=12),
     *             @OA\Property(property="exp_year", type="integer", example=2026),
     *             @OA\Property(property="card_holder_name", type="string", example="John Doe"),
     *             @OA\Property(property="createdby_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function store() {}
}
