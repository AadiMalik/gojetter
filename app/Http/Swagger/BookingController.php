<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/booking-list",
     *     summary="Get all bookings",
     *     description="Returns a list of bookings with tour and user details",
     *     operationId="getBookingList",
     *     tags={"Booking"},
     *     security={{"bearerAuth":{}}},
     * 
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="tour_id", type="integer", example=1),
     *                     @OA\Property(property="user_id", type="integer", example=13),
     *                     @OA\Property(property="booking_date", type="string", format="date", example="2025-08-15"),
     *                     @OA\Property(property="first_name", type="string", example="John"),
     *                     @OA\Property(property="last_name", type="string", example="Doe"),
     *                     @OA\Property(property="email", type="string", example="john@example.com"),
     *                     @OA\Property(property="phone", type="string", example="1234567890"),
     *                     @OA\Property(property="country", type="string", example="USA"),
     *                     @OA\Property(property="zipcode", type="string", example="10001"),
     *                     @OA\Property(property="address", type="string", example="123 Street"),
     *                     @OA\Property(property="adults", type="integer", example=2),
     *                     @OA\Property(property="children", type="integer", example=1),
     *                     @OA\Property(property="total_participants", type="integer", example=3),
     *                     @OA\Property(property="sub_total", type="string", example="300.00"),
     *                     @OA\Property(property="tax_percent", type="string", example="5.00"),
     *                     @OA\Property(property="tax_amount", type="string", example="15.00"),
     *                     @OA\Property(property="discount", type="string", example="10.00"),
     *                     @OA\Property(property="total", type="string", example="305.00"),
     *                     @OA\Property(property="payment_method", type="string", example="card"),
     *                     @OA\Property(property="coupon_id", type="integer", nullable=true, example=null),
     *                     @OA\Property(property="status", type="string", example="confirmed"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-28T19:13:43.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-28T19:17:50.000000Z"),

     *                     @OA\Property(
     *                         property="tour",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="title", type="string", example="Desert Safari"),
     *                         @OA\Property(property="slug", type="string", example="desert-safari"),
     *                         @OA\Property(property="thumbnail", type="string", example="tours/sample.jpg"),
     *                         @OA\Property(property="overview", type="string", example="<p>Desert adventure</p>"),
     *                         @OA\Property(property="short_description", type="string", example="<h2>Highlights</h2>..."),
     *                         @OA\Property(property="full_description", type="string", example="<h2>Included/Excluded</h2>..."),
     *                         @OA\Property(property="duration_days", type="integer", example=1),
     *                         @OA\Property(property="duration_nights", type="integer", example=0),
     *                         @OA\Property(property="tour_type", type="string", nullable=true),
     *                         @OA\Property(property="group_size", type="integer", example=10),
     *                         @OA\Property(property="languages", type="string", example="English"),
     *                         @OA\Property(property="price", type="string", example="176.00"),
     *                         @OA\Property(property="min_adults", type="integer", example=2),
     *                         @OA\Property(property="location", type="string", example="DAE"),
     *                         @OA\Property(property="is_active", type="integer", example=1),
     *                         @OA\Property(property="thumbnail_url", type="string", format="url", example="http://localhost/storage/tours/sample.jpg")
     *                     ),

     *                     @OA\Property(
     *                         property="user",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=13),
     *                         @OA\Property(property="name", type="string", example="new user 6"),
     *                         @OA\Property(property="email", type="string", example="user6@gmail.com"),
     *                         @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-07-14T17:30:12.000000Z"),
     *                         @OA\Property(property="username", type="string", example="user6"),
     *                         @OA\Property(property="phone", type="string", example="03000000001"),
     *                         @OA\Property(property="paypal_email", type="string", nullable=true),
     *                         @OA\Property(property="is_show_email_phone", type="integer", example=0),
     *                         @OA\Property(property="home_airport", type="string", example="lahore"),
     *                         @OA\Property(property="gender", type="string", example="Male"),
     *                         @OA\Property(property="country_id", type="integer", example=1),
     *                         @OA\Property(property="created_at", type="string", format="date-time"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time")
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/save-booking",
     *     tags={"Booking"},
     *     summary="Create a new tour booking with details",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tour_id", "booking_date", "first_name", "last_name", "email", "phone", "country", "zipcode", "address", "adults", "children", "sub_total", "total", "payment_method", "booking_details"},
     *             @OA\Property(property="tour_id", type="integer", example=1),
     *             @OA\Property(property="booking_date", type="string", format="date", example="2025-08-15"),
     *             @OA\Property(property="first_name", type="string", example="John"),
     *             @OA\Property(property="last_name", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="phone", type="string", example="1234567890"),
     *             @OA\Property(property="country", type="string", example="USA"),
     *             @OA\Property(property="zipcode", type="string", example="10001"),
     *             @OA\Property(property="address", type="string", example="123 Street"),
     *             @OA\Property(property="adults", type="integer", example=2),
     *             @OA\Property(property="children", type="integer", example=1),
     *             @OA\Property(property="sub_total", type="number", format="float", example=300.00),
     *             @OA\Property(property="tax_percent", type="number", format="float", nullable=true, example=5.00),
     *             @OA\Property(property="tax_amount", type="number", format="float", nullable=true, example=15.00),
     *             @OA\Property(property="discount", type="number", format="float", nullable=true, example=10.00),
     *             @OA\Property(property="total", type="number", format="float", example=305.00),
     *             @OA\Property(property="payment_method", type="string", example="card"),
     *             @OA\Property(property="coupon_id", type="integer", nullable=true, example=null),
     *             @OA\Property(
     *                 property="booking_details",
     *                 type="array",
     *                 minItems=1,
     *                 @OA\Items(
     *                     @OA\Property(property="first_name", type="string", example="Alice"),
     *                     @OA\Property(property="last_name", type="string", example="Smith"),
     *                     @OA\Property(property="type", type="string", enum={"adult", "child"}, example="adult"),
     *                     @OA\Property(property="dob", type="string", format="date", example="1990-01-01"),
     *                     @OA\Property(property="weight", type="string", example="60"),
     *                     @OA\Property(property="weight_unit", type="string", example="kg")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking saved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Record saved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(property="Status", type="integer", example=200),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="tour_id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=13),
     *                 @OA\Property(property="booking_date", type="string", format="date", example="2025-08-15"),
     *                 @OA\Property(property="first_name", type="string", example="John"),
     *                 @OA\Property(property="last_name", type="string", example="Doe"),
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="phone", type="string", example="1234567890"),
     *                 @OA\Property(property="country", type="string", example="USA"),
     *                 @OA\Property(property="zipcode", type="string", example="10001"),
     *                 @OA\Property(property="address", type="string", example="123 Street"),
     *                 @OA\Property(property="adults", type="integer", example=2),
     *                 @OA\Property(property="children", type="integer", example=1),
     *                 @OA\Property(property="total_participants", type="integer", example=3),
     *                 @OA\Property(property="sub_total", type="number", example="300.00"),
     *                 @OA\Property(property="tax_percent", type="number", example="5.00"),
     *                 @OA\Property(property="tax_amount", type="number", example="15.00"),
     *                 @OA\Property(property="discount", type="number", example="10.00"),
     *                 @OA\Property(property="total", type="number", example="305.00"),
     *                 @OA\Property(property="payment_method", type="string", example="card"),
     *                 @OA\Property(property="coupon_id", type="integer", example=null),
     *                 @OA\Property(property="status", type="string", example="pending"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="tour", type="object", example={"id":1,"title":"Desert Safari"}),
     *                 @OA\Property(property="user", type="object", example={"id":13,"name":"new user 6","email":"user6@gmail.com"})
     *             )
     *         )
     *     )
     * )
     */
    public function store() {}
}
