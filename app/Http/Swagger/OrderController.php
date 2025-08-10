<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/order-list",
     *     summary="Get order list",
     *     description="Retrieve a list of orders for the authenticated user with order details, user info, card info, and currency info.",
     *     tags={"Order"},
     *     security={{"authbearer": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Records retrieved successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="user_id", type="integer", example=13),
     *                     @OA\Property(property="order_date", type="string", format="date", example="2025-08-10"),
     *                     @OA\Property(property="first_name", type="string", example="John"),
     *                     @OA\Property(property="last_name", type="string", example="Doe"),
     *                     @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                     @OA\Property(property="phone", type="string", example="+1234567890"),
     *                     @OA\Property(property="country", type="string", example="USA"),
     *                     @OA\Property(property="zipcode", type="string", example="90210"),
     *                     @OA\Property(property="address", type="string", example="123 Beverly Hills Street"),
     *                     @OA\Property(property="quantity", type="integer", example=4),
     *                     @OA\Property(property="sub_total", type="string", example="240.00"),
     *                     @OA\Property(property="tax_percent", type="string", example="0.00"),
     *                     @OA\Property(property="tax_amount", type="string", example="0.00"),
     *                     @OA\Property(property="discount", type="string", example="0.00"),
     *                     @OA\Property(property="total", type="string", example="240.00"),
     *                     @OA\Property(property="payment_method", type="string", example="credit_card"),
     *                     @OA\Property(property="currency_id", type="integer", example=1),
     *                     @OA\Property(property="card_id", type="integer", example=1),
     *                     @OA\Property(property="coupon_id", type="integer", nullable=true, example=null),
     *                     @OA\Property(property="status", type="string", example="pending"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                     @OA\Property(
     *                         property="order_detail",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="id", type="integer", example=3),
     *                             @OA\Property(property="order_id", type="integer", example=1),
     *                             @OA\Property(property="activity_id", type="integer", example=1),
     *                             @OA\Property(property="activity_date_id", type="integer", example=1),
     *                             @OA\Property(property="activity_time_slot_id", type="integer", example=1),
     *                             @OA\Property(property="quantity", type="integer", example=1),
     *                             @OA\Property(property="price", type="string", example="60.00"),
     *                             @OA\Property(property="total", type="string", example="60.00"),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z")
     *                         )
     *                     ),
     *                     @OA\Property(
     *                         property="user",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=13),
     *                         @OA\Property(property="name", type="string", example="new user 6"),
     *                         @OA\Property(property="email", type="string", example="user6@gmail.com"),
     *                         @OA\Property(property="username", type="string", example="user6"),
     *                         @OA\Property(property="phone", type="string", example="03000000001"),
     *                         @OA\Property(property="home_airport", type="string", example="lahore"),
     *                         @OA\Property(property="gender", type="string", example="Male")
     *                     ),
     *                     @OA\Property(
     *                         property="card",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="stripe_payment_method_id", type="string", example="pm_1RoPFoRXlgMmIgSkS39eKxZK"),
     *                         @OA\Property(property="card_holder_name", type="string", example="test"),
     *                         @OA\Property(property="card_brand", type="string", example="mastercard"),
     *                         @OA\Property(property="card_last_four", type="string", example="4242"),
     *                         @OA\Property(property="exp_month", type="string", example="1"),
     *                         @OA\Property(property="exp_year", type="string", example="28"),
     *                         @OA\Property(property="is_default", type="integer", example=1)
     *                     ),
     *                     @OA\Property(
     *                         property="currency",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="code", type="string", example="USD"),
     *                         @OA\Property(property="symbol", type="string", example="$"),
     *                         @OA\Property(property="rate", type="string", example="1.0000"),
     *                         @OA\Property(property="is_default", type="integer", example=1)
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/save-order",
     *     tags={"Order"},
     *     summary="Save a new order",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={
     *                 "card_id",
     *                 "currency_id",
     *                 "first_name",
     *                 "last_name",
     *                 "email",
     *                 "phone",
     *                 "country",
     *                 "zipcode",
     *                 "address",
     *                 "payment_method"
     *             },
     *             @OA\Property(property="card_id", type="integer", example=1, description="ID of the customer card"),
     *             @OA\Property(property="currency_id", type="integer", example=1, description="ID of the currency"),
     *             @OA\Property(property="first_name", type="string", example="John"),
     *             @OA\Property(property="last_name", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="phone", type="string", example="+1234567890"),
     *             @OA\Property(property="country", type="string", example="USA"),
     *             @OA\Property(property="zipcode", type="string", example="90210"),
     *             @OA\Property(property="address", type="string", example="123 Beverly Hills Street"),
     *             @OA\Property(property="discount", type="number", format="float", example=5, nullable=true, description="Optional discount"),
     *             @OA\Property(property="payment_method", type="string", example="credit_card"),
     *             @OA\Property(property="coupon_id", type="integer", example=10, nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order saved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Data", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/api/order-detail/{id}",
     *     tags={"Order"},
     *     summary="Get order detail by ID",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Order ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record details retrieved successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Record details retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=13),
     *                 @OA\Property(property="order_date", type="string", format="date", example="2025-08-10"),
     *                 @OA\Property(property="first_name", type="string", example="John"),
     *                 @OA\Property(property="last_name", type="string", example="Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                 @OA\Property(property="phone", type="string", example="+1234567890"),
     *                 @OA\Property(property="country", type="string", example="USA"),
     *                 @OA\Property(property="zipcode", type="string", example="90210"),
     *                 @OA\Property(property="address", type="string", example="123 Beverly Hills Street"),
     *                 @OA\Property(property="quantity", type="integer", example=4),
     *                 @OA\Property(property="sub_total", type="string", example="240.00"),
     *                 @OA\Property(property="tax_percent", type="string", example="0.00"),
     *                 @OA\Property(property="tax_amount", type="string", example="0.00"),
     *                 @OA\Property(property="discount", type="string", example="0.00"),
     *                 @OA\Property(property="total", type="string", example="240.00"),
     *                 @OA\Property(property="payment_method", type="string", example="credit_card"),
     *                 @OA\Property(property="currency_id", type="integer", example=1),
     *                 @OA\Property(property="card_id", type="integer", example=1),
     *                 @OA\Property(property="coupon_id", type="integer", nullable=true, example=null),
     *                 @OA\Property(property="status", type="string", example="pending"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                 
     *                 @OA\Property(
     *                     property="order_detail",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=3),
     *                         @OA\Property(property="order_id", type="integer", example=1),
     *                         @OA\Property(property="activity_id", type="integer", example=1),
     *                         @OA\Property(property="activity_date_id", type="integer", example=1),
     *                         @OA\Property(property="activity_time_slot_id", type="integer", example=1),
     *                         @OA\Property(property="quantity", type="integer", example=1),
     *                         @OA\Property(property="price", type="string", example="60.00"),
     *                         @OA\Property(property="total", type="string", example="60.00"),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z"),
     *                         
     *                         @OA\Property(
     *                             property="activity",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="title", type="string", example="Deserunt veniam eos"),
     *                             @OA\Property(property="slug", type="string", example="deserunt-veniam-eos"),
     *                             @OA\Property(property="thumbnail", type="string", example="activity/oaGYJKQdsi89E6TpOSyBw5AnI5JvusXdOok3litt.jpg"),
     *                             @OA\Property(property="overview", type="string", example="Voluptatem rem fugia"),
     *                             @OA\Property(property="short_description", type="string", example="Similique quam illum"),
     *                             @OA\Property(property="highlights", type="string", example="Irure pariatur Ipsa"),
     *                             @OA\Property(property="full_description", type="string", example="Eos cillum est qui p"),
     *                             @OA\Property(property="tags", type="string", example="Est velit quis quis"),
     *                             @OA\Property(property="category_id", type="integer", example=1),
     *                             @OA\Property(property="is_featured", type="integer", example=0),
     *                             @OA\Property(property="difficulty_level", type="string", example="easy"),
     *                             @OA\Property(property="age_limit", type="integer", example=74),
     *                             @OA\Property(property="pickup_info", type="string", example="Excepturi consectetu"),
     *                             @OA\Property(property="dropoff_info", type="string", example="Maxime voluptas quas"),
     *                             @OA\Property(property="location", type="string", example="Aut dignissimos iste"),
     *                             @OA\Property(property="duration", type="string", example="Cumque assumenda nul"),
     *                             @OA\Property(property="languages", type="string", example="Ratione aliquid sed"),
     *                             @OA\Property(property="min_adults", type="integer", nullable=true, example=null),
     *                             @OA\Property(property="group_size", type="integer", example=29),
     *                             @OA\Property(property="activity_type", type="string", example="private"),
     *                             @OA\Property(property="is_wheelchair_accessible", type="integer", example=1),
     *                             @OA\Property(property="is_stroller_friendly", type="integer", example=1),
     *                             @OA\Property(property="cut_of_day", type="integer", example=25),
     *                             @OA\Property(property="rules", type="string", example="Eum voluptas hic qui"),
     *                             @OA\Property(property="requirements", type="string", example="Error dignissimos ex"),
     *                             @OA\Property(property="disclaimers", type="string", example="Incidunt quisquam d"),
     *                             @OA\Property(property="is_active", type="integer", example=1),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:37:20.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:37:20.000000Z"),
     *                             @OA\Property(property="thumbnail_url", type="string", example="http://localhost/gojetter/storage/app/public/activity/oaGYJKQdsi89E6TpOSyBw5AnI5JvusXdOok3litt.jpg")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_date",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="activity_id", type="integer", example=1),
     *                             @OA\Property(property="date", type="string", format="date", example="2025-08-11"),
     *                             @OA\Property(property="price", type="string", example="60.00"),
     *                             @OA\Property(property="discount_price", type="string", example="0.00"),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:37:38.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:37:38.000000Z")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_time_slot",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="activity_date_id", type="integer", example=1),
     *                             @OA\Property(property="start_time", type="string", example="09 PM"),
     *                             @OA\Property(property="end_time", type="string", example="10 PM"),
     *                             @OA\Property(property="total_seats", type="integer", example=120),
     *                             @OA\Property(property="available_seats", type="integer", example=116),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:38:24.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:54:40.000000Z")
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="user",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=13),
     *                     @OA\Property(property="name", type="string", example="new user 6"),
     *                     @OA\Property(property="email", type="string", example="user6@gmail.com"),
     *                     @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-14T17:30:12.000000Z"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-14T12:21:22.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-17T15:21:49.000000Z"),
     *                     @OA\Property(property="username", type="string", example="user6"),
     *                     @OA\Property(property="phone", type="string", example="03000000001"),
     *                     @OA\Property(property="paypal_email", type="string", nullable=true, example=null),
     *                     @OA\Property(property="is_show_email_phone", type="integer", example=0),
     *                     @OA\Property(property="about_yourself", type="string", nullable=true, example=null),
     *                     @OA\Property(property="avatar", type="string", nullable=true, example=null),
     *                     @OA\Property(property="home_airport", type="string", example="lahore"),
     *                     @OA\Property(property="address", type="string", nullable=true, example=null),
     *                     @OA\Property(property="city", type="string", nullable=true, example=null),
     *                     @OA\Property(property="state", type="string", nullable=true, example=null),
     *                     @OA\Property(property="zip_code", type="string", nullable=true, example=null),
     *                     @OA\Property(property="country_id", type="integer", example=1),
     *                     @OA\Property(property="alternative_phone", type="string", nullable=true, example=null),
     *                     @OA\Property(property="gender", type="string", example="Male"),
     *                     @OA\Property(property="stripe_customer_id", type="string", nullable=true, example=null)
     *                 ),
     *                 @OA\Property(
     *                     property="card",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="user_id", type="integer", example=13),
     *                     @OA\Property(property="stripe_payment_method_id", type="string", example="pm_1RoPFoRXlgMmIgSkS39eKxZK"),
     *                     @OA\Property(property="card_holder_name", type="string", example="test"),
     *                     @OA\Property(property="card_brand", type="string", example="mastercard"),
     *                     @OA\Property(property="card_last_four", type="string", example="4242"),
     *                     @OA\Property(property="exp_month", type="string", example="1"),
     *                     @OA\Property(property="exp_year", type="string", example="28"),
     *                     @OA\Property(property="cvc", type="string", example="123"),
     *                     @OA\Property(property="is_default", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", nullable=true, example=null),
     *                     @OA\Property(property="updated_at", type="string", nullable=true, example=null)
     *                 ),
     *                 @OA\Property(
     *                     property="currency",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="code", type="string", example="USD"),
     *                     @OA\Property(property="symbol", type="string", example="$"),
     *                     @OA\Property(property="rate", type="string", example="1.0000"),
     *                     @OA\Property(property="is_default", type="integer", example=1),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-08T16:36:49.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-08T16:38:17.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function getOrderDetail() {}
}
