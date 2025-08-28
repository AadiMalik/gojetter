<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/home",
     *     summary="Retrieve home page data",
     *     description="Fetches top-selling activities, discount tours, and discount destinations. Optionally accepts a user_id to personalize the response (e.g., for wishlist status).",
     *     tags={"Home"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="Optional user ID to personalize the response (e.g., for wishlist status).",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with home page data",
     *         @OA\JsonContent(
     *             @OA\Property(property="Message", type="string", example="Records retrieved successfully."),
     *             @OA\Property(property="Success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="Data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="top_selling_activities",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="title", type="string", example="Deserunt veniam eos"),
     *                         @OA\Property(property="slug", type="string", example="deserunt-veniam-eos"),
     *                         @OA\Property(property="thumbnail", type="string", example="activity/oaGYJKQdsi89E6TpOSyBw5AnI5JvusXdOok3litt.jpg"),
     *                         @OA\Property(property="thumbnail_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/activity/oaGYJKQdsi89E6TpOSyBw5AnI5JvusXdOok3litt.jpg"),
     *                         @OA\Property(property="overview", type="string", example="Voluptatem rem fugia"),
     *                         @OA\Property(property="short_description", type="string", example="Similique quam illum"),
     *                         @OA\Property(property="highlights", type="string", example="Irure pariatur Ipsa"),
     *                         @OA\Property(property="full_description", type="string", example="Eos cillum est qui p"),
     *                         @OA\Property(property="tags", type="string", example="Est velit quis quis"),
     *                         @OA\Property(property="category_id", type="integer", example=1),
     *                         @OA\Property(property="is_featured", type="integer", example=1),
     *                         @OA\Property(property="difficulty_level", type="string", example="easy"),
     *                         @OA\Property(property="age_limit", type="integer", example=74),
     *                         @OA\Property(property="pickup_info", type="string", example="Excepturi consectetu"),
     *                         @OA\Property(property="dropoff_info", type="string", example="Maxime voluptas quas"),
     *                         @OA\Property(property="location", type="string", example="Aut dignissimos iste"),
     *                         @OA\Property(property="duration", type="string", example="Cumque assumenda nul"),
     *                         @OA\Property(property="languages", type="string", example="Ratione aliquid sed"),
     *                         @OA\Property(property="min_adults", type="integer", nullable=true),
     *                         @OA\Property(property="group_size", type="integer", example=29),
     *                         @OA\Property(property="activity_type", type="string", example="private"),
     *                         @OA\Property(property="is_wheelchair_accessible", type="integer", example=1),
     *                         @OA\Property(property="is_stroller_friendly", type="integer", example=1),
     *                         @OA\Property(property="cut_of_day", type="integer", example=25),
     *                         @OA\Property(property="rules", type="string", example="Eum voluptas hic qui"),
     *                         @OA\Property(property="requirements", type="string", example="Error dignissimos ex"),
     *                         @OA\Property(property="disclaimers", type="string", example="Incidunt quisquam d"),
     *                         @OA\Property(property="is_active", type="integer", example=1),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:37:20.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T18:26:09.000000Z"),
     *                         @OA\Property(property="destination_id", type="integer", example=1),
     *                         @OA\Property(property="total_sales", type="integer", example=4),
     *                         @OA\Property(property="average_rating", type="number", nullable=true),
     *                         @OA\Property(property="is_wishlist", type="integer", example=0),
     *                         @OA\Property(
     *                             property="destination",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="name", type="string", example="Swat"),
     *                             @OA\Property(property="is_active", type="integer", example=1),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-19T11:38:55.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T11:38:55.000000Z")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_category",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="name", type="string", example="Adventure"),
     *                             @OA\Property(property="thumbnail", type="string", example="tour_category/QHUepWqheiPqsqbcNmeYkbuaXrivC0koChYk2hwl.jpg"),
     *                             @OA\Property(property="is_active", type="integer", example=1),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-15T14:40:26.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-15T14:41:16.000000Z"),
     *                             @OA\Property(property="thumbnail_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tour_category/QHUepWqheiPqsqbcNmeYkbuaXrivC0koChYk2hwl.jpg")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_image",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_date",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="activity_id", type="integer", example=1),
     *                                 @OA\Property(property="date", type="string", format="date", example="2025-08-11"),
     *                                 @OA\Property(property="price", type="string", example="60.00"),
     *                                 @OA\Property(property="discount_price", type="string", example="0.00"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:37:38.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T16:37:38.000000Z"),
     *                                 @OA\Property(
     *                                     property="activity_time_slot",
     *                                     type="array",
     *                                     @OA\Items(
     *                                         type="object",
     *                                         @OA\Property(property="id", type="integer", example=1),
     *                                         @OA\Property(property="activity_date_id", type="integer", example=1),
     *                                         @OA\Property(property="start_time", type="string", example="09 PM"),
     *                                         @OA\Property(property="end_time", type="string", example="10 PM"),
     *                                         @OA\Property(property="total_seats", type="integer", example=120),
     *                                         @OA\Property(property="available_seats", type="integer", example=112),
     *                                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-10T16:38:24.000000Z"),
     *                                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-10T17:42:14.000000Z")
     *                                     )
     *                                 )
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="activity_expectation",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_exclusion",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_policy",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_inclusion",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_reviews",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         ),
     *                         @OA\Property(
     *                             property="activity_not_suitable",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="activity_id", type="integer", example=1),
     *                                 @OA\Property(property="item", type="string", example="Dinner in the Sky entry tickets"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-18T17:42:38.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-18T17:42:38.000000Z")
     *                             )
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="discount_tours",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="title", type="string", example="Desert Safari"),
     *                         @OA\Property(property="slug", type="string", example="desert-safari"),
     *                         @OA\Property(property="thumbnail", type="string", example="tours/6EAGsI1AToXBe0EghcVItdlqWS8O5YVCFTsYYOGQ.jpg"),
     *                         @OA\Property(property="thumbnail_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tours/6EAGsI1AToXBe0EghcVItdlqWS8O5YVCFTsYYOGQ.jpg"),
     *                         @OA\Property(property="overview", type="string", example="<p>Discover the essence of Dubai or the UAE with our captivating desert safari tour...</p>"),
     *                         @OA\Property(property="short_description", type="string", example="<h2>Highlights</h2><ul>...</ul>"),
     *                         @OA\Property(property="full_description", type="string", example="<h2>Included/Excluded</h2><div>...</div>"),
     *                         @OA\Property(property="tour_type", type="string", example="private"),
     *                         @OA\Property(property="group_size", type="integer", example=10),
     *                         @OA\Property(property="languages", type="string", example="English"),
     *                         @OA\Property(property="min_adults", type="integer", example=2),
     *                         @OA\Property(property="location", type="string", example="DAE"),
     *                         @OA\Property(property="is_active", type="integer", example=1),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-17T19:00:44.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T11:44:56.000000Z"),
     *                         @OA\Property(property="tour_category_id", type="integer", example=1),
     *                         @OA\Property(property="duration", type="string", example="5 Days, 4 Nights"),
     *                         @OA\Property(property="tags", type="string", example="burj , khalifa , amazon , jungle, expedition"),
     *                         @OA\Property(property="is_featured", type="integer", example=1),
     *                         @OA\Property(property="highlights", type="string", example="333"),
     *                         @OA\Property(property="difficulty_level", type="string", example="easy"),
     *                         @OA\Property(property="age_limit", type="integer", example=33),
     *                         @OA\Property(property="pickup_info", type="string", example="Excepturi consectetu"),
     *                         @OA\Property(property="dropoff_info", type="string", example="Maxime voluptas quas"),
     *                         @OA\Property(property="cut_of_day", type="integer", example=0),
     *                         @OA\Property(property="destination_id", type="integer", example=1),
     *                         @OA\Property(property="average_rating", type="number", nullable=true),
     *                         @OA\Property(property="is_wishlist", type="integer", example=0),
     *                         @OA\Property(
     *                             property="destination",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="name", type="string", example="Swat"),
     *                             @OA\Property(property="is_active", type="integer", example=1),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-19T11:38:55.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T11:38:55.000000Z")
     *                         ),
     *                         @OA\Property(
     *                             property="tour_category",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="name", type="string", example="Adventure"),
     *                             @OA\Property(property="thumbnail", type="string", example="tour_category/QHUepWqheiPqsqbcNmeYkbuaXrivC0koChYk2hwl.jpg"),
     *                             @OA\Property(property="is_active", type="integer", example=1),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-15T14:40:26.000000Z"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-15T14:41:16.000000Z"),
     *                             @OA\Property(property="thumbnail_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tour_category/QHUepWqheiPqsqbcNmeYkbuaXrivC0koChYk2hwl.jpg")
     *                         ),
     *                         @OA\Property(
     *                             property="tour_image",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=3),
     *                                 @OA\Property(property="name", type="string", example="Testing Data"),
     *                                 @OA\Property(property="image", type="string", example="tours/xEsGCb5Osek2l8gAQoA1RdhBd5cZ2qPEbSVXRkuz.jpg"),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-05T15:24:06.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-05T15:24:06.000000Z"),
     *                                 @OA\Property(property="image_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tours/xEsGCb5Osek2l8gAQoA1RdhBd5cZ2qPEbSVXRkuz.jpg")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_date",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=2),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="start_date", type="string", format="date", example="2025-08-30"),
     *                                 @OA\Property(property="end_date", type="string", format="date", example="2025-09-03"),
     *                                 @OA\Property(property="price", type="string", example="250.00"),
     *                                 @OA\Property(property="discount_price", type="string", example="200.00"),
     *                                 @OA\Property(property="price_type", type="string", example="per_person"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-19T18:53:24.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T18:53:24.000000Z")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_download",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="file_type", type="string", example="image"),
     *                                 @OA\Property(property="file_path", type="string", example="tours/qEsQOjLX3DuOaA5iZR6OmUsbyvd0t07wH0emRT3q.jpg"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-07T19:46:29.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-07T19:46:29.000000Z"),
     *                                 @OA\Property(property="file_path_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tours/qEsQOjLX3DuOaA5iZR6OmUsbyvd0t07wH0emRT3q.jpg")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_exclusion",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="item", type="string", example="❌ International or domestic flight tickets"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-07T19:45:03.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-07T19:45:03.000000Z")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_faq",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=2),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="question", type="string", example="❓ What is included in the tour package?"),
     *                                 @OA\Property(property="answer", type="string", example="The package includes guided tours, transportation, entry tickets to all listed attractions, and bottled water. Please refer to the inclusions section for a complete list."),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-07T19:45:54.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-07T19:45:54.000000Z")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_inclusion",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=2),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="item", type="string", example="Professional English-speaking tour guide"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-07T19:44:04.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-07T19:44:04.000000Z")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_itinerary",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=2),
     *                                 @OA\Property(property="tour_id", type="integer", example=1),
     *                                 @OA\Property(property="day_number", type="integer", example=1),
     *                                 @OA\Property(property="title", type="string", example="Day 1"),
     *                                 @OA\Property(property="description", type="string", example="Align images with the helper float classes or text alignment classes. block-level images can be centered using the .mx-auto margin utility class."),
     *                                 @OA\Property(property="image", type="string", example="tours/7ol9Wn56wQb2DKct09MGgIzooB5DHKTsAeF382EI.jpg"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-07T19:41:12.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-07T19:41:12.000000Z"),
     *                                 @OA\Property(property="image_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tours/7ol9Wn56wQb2DKct09MGgIzooB5DHKTsAeF382EI.jpg")
     *                             )
     *                         ),
     *                         @OA\Property(
     *                             property="tour_reviews",
     *                             type="array",
     *                             @OA\Items(type="object")
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="discount_destinations",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="destination_id", type="integer", example=1),
     *                         @OA\Property(property="destination_name", type="string", example="Swat"),
     *                         @OA\Property(property="is_active", type="integer", example=1),
     *                         @OA\Property(
     *                             property="tours",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="title", type="string", example="Desert Safari"),
     *                                 @OA\Property(property="slug", type="string", example="desert-safari"),
     *                                 @OA\Property(property="thumbnail", type="string", example="tours/6EAGsI1AToXBe0EghcVItdlqWS8O5YVCFTsYYOGQ.jpg"),
     *                                 @OA\Property(property="thumbnail_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tours/6EAGsI1AToXBe0EghcVItdlqWS8O5YVCFTsYYOGQ.jpg"),
     *                                 @OA\Property(property="overview", type="string", example="<p>Discover the essence of Dubai or the UAE with our captivating desert safari tour...</p>"),
     *                                 @OA\Property(property="short_description", type="string", example="<h2>Highlights</h2><ul>...</ul>"),
     *                                 @OA\Property(property="full_description", type="string", example="<h2>Included/Excluded</h2><div>...</div>"),
     *                                 @OA\Property(property="tour_type", type="string", example="private"),
     *                                 @OA\Property(property="group_size", type="integer", example=10),
     *                                 @OA\Property(property="languages", type="string", example="English"),
     *                                 @OA\Property(property="min_adults", type="integer", example=2),
     *                                 @OA\Property(property="location", type="string", example="DAE"),
     *                                 @OA\Property(property="is_active", type="integer", example=1),
     *                                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-17T19:00:44.000000Z"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T11:44:56.000000Z"),
     *                                 @OA\Property(property="tour_category_id", type="integer", example=1),
     *                                 @OA\Property(property="duration", type="string", example="5 Days, 4 Nights"),
     *                                 @OA\Property(property="tags", type="string", example="burj , khalifa , amazon , jungle, expedition"),
     *                                 @OA\Property(property="is_featured", type="integer", example=1),
     *                                 @OA\Property(property="highlights", type="string", example="333"),
     *                                 @OA\Property(property="difficulty_level", type="string", example="easy"),
     *                                 @OA\Property(property="age_limit", type="integer", example=33),
     *                                 @OA\Property(property="pickup_info", type="string", example="Excepturi consectetu"),
     *                                 @OA\Property(property="dropoff_info", type="string", example="Maxime voluptas quas"),
     *                                 @OA\Property(property="cut_of_day", type="integer", example=0),
     *                                 @OA\Property(property="destination_id", type="integer", example=1),
     *                                 @OA\Property(property="average_rating", type="number", nullable=true),
     *                                 @OA\Property(property="is_wishlist", type="integer", example=0),
     *                                 @OA\Property(
     *                                     property="destination",
     *                                     type="object",
     *                                     @OA\Property(property="id", type="integer", example=1),
     *                                     @OA\Property(property="name", type="string", example="Swat"),
     *                                     @OA\Property(property="is_active", type="integer", example=1),
     *                                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-19T11:38:55.000000Z"),
     *                                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-19T11:38:55.000000Z")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_category",
     *                                     type="object",
     *                                     @OA\Property(property="id", type="integer", example=1),
     *                                     @OA\Property(property="name", type="string", example="Adventure"),
     *                                     @OA\Property(property="thumbnail", type="string", example="tour_category/QHUepWqheiPqsqbcNmeYkbuaXrivC0koChYk2hwl.jpg"),
     *                                     @OA\Property(property="is_active", type="integer", example=1),
     *                                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-15T14:40:26.000000Z"),
     *                                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-15T14:41:16.000000Z"),
     *                                     @OA\Property(property="thumbnail_url", type="string", format="uri", example="http://localhost/gojetter/storage/app/public/tour_category/QHUepWqheiPqsqbcNmeYkbuaXrivC0koChYk2hwl.jpg")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_image",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_date",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_download",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_exclusion",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_faq",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_inclusion",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_itinerary",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 ),
     *                                 @OA\Property(
     *                                     property="tour_reviews",
     *                                     type="array",
     *                                     @OA\Items(type="object")
     *                                 )
     *                             )
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="Status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function api() {}
}
