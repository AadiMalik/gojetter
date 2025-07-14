<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/term-and-condition",
     *     summary="Get Terms and Conditions",
     *     tags={"Common"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Records retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="<b>Terms and conditions</b> for a tours website and mobile app should outline user responsibilities..."
     *                 ),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-09T17:01:21.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-09T17:02:15.000000Z")
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function termAndCondition() {}

    /**
     * @OA\Get(
     *     path="/api/privacy-policy",
     *     summary="Get Privacy Policy",
     *     tags={"Common"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Records retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="<b>Privacy Policy</b> outlines how we collect, use, and protect your personal information..."
     *                 ),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-09T17:01:21.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-09T17:02:15.000000Z")
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function privacyPolicy() {}

    /**
     * @OA\Get(
     *     path="/api/faqs",
     *     summary="Get list of FAQs",
     *     tags={"Common"},
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
     *                     @OA\Property(property="question", type="string", example="What is this?"),
     *                     @OA\Property(property="answer", type="string", example="<p>This is a tour website and applications.</p>"),
     *                     @OA\Property(property="is_active", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-09T13:09:54.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-09T13:09:54.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function faqs(){}
}
