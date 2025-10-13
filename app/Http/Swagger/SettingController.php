<?php

namespace App\Http\Swagger;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
      /**
       * @OA\Get(
       *     path="/api/setting",
       *     tags={"Settings"},
       *     summary="Get application & website settings",
       *     description="Retrieve global application and website settings including logos and URLs.",
       *     operationId="getSettings",
       *
       *     @OA\Response(
       *         response=200,
       *         description="Records retrieved successfully.",
       *         @OA\JsonContent(
       *             type="object",
       *             example={
       *                 "Message": "Records retrieved successfully.",
       *                 "Success": true,
       *                 "Data": {
       *                     "id": 1,
       *                     "app_name": "Go Jetter",
       *                     "tab_logo": "settings/4LUKR7D4D58McJqcxHLLUyjUIc9l848bmR9fIgK5.png",
       *                     "admin_panel_logo": "settings/QOzoXO0QqxymNJ2vZZyNKioFc7UqN6GZUhMsgJVM.png",
       *                     "mobile_application_logo": "settings/a9Wvgq7guL8ld8zYbJnp5ohjNUYhZhzLs4LbDW04.png",
       *                     "mobile_application_home_image": "settings/BFXJFHQY4wpo51Bh7lxFeRCjcPrU9ZkBLrwkqcqz.webp",
       *                     "website_logo": "settings/KYiaoUhwYcuORwdoeQI9rTwtas0M8JHQM8tWn11q.png",
       *                     "website_page_image": "settings/tB27BjQ3s69v5xe33SDBHbienAvcxWTyi1n3LczY.webp",
       *                     "support_email": null,
       *                     "contact_number": null,
       *                     "created_at": "2025-09-24T22:27:24.000000Z",
       *                     "updated_at": "2025-09-24T22:27:24.000000Z",
       *                     "tab_logo_url": "http://localhost/gojetter/storage/app/public/settings/4LUKR7D4D58McJqcxHLLUyjUIc9l848bmR9fIgK5.png",
       *                     "admin_panel_logo_url": "http://localhost/gojetter/storage/app/public/settings/QOzoXO0QqxymNJ2vZZyNKioFc7UqN6GZUhMsgJVM.png",
       *                     "mobile_application_logo_url": "http://localhost/gojetter/storage/app/public/settings/a9Wvgq7guL8ld8zYbJnp5ohjNUYhZhzLs4LbDW04.png",
       *                     "mobile_application_home_image_url": "http://localhost/gojetter/storage/app/public/settings/BFXJFHQY4wpo51Bh7lxFeRCjcPrU9ZkBLrwkqcqz.webp",
       *                     "website_logo_url": "http://localhost/gojetter/storage/app/public/settings/KYiaoUhwYcuORwdoeQI9rTwtas0M8JHQM8tWn11q.png",
       *                     "website_page_image_url": "http://localhost/gojetter/storage/app/public/settings/tB27BjQ3s69v5xe33SDBHbienAvcxWTyi1n3LczY.webp"
       *                 },
       *                 "Status": 200
       *             }
       *         )
       *     ),
       *     @OA\Response(
       *         response=404,
       *         description="Settings not found",
       *         @OA\JsonContent(
       *             type="object",
       *             example={
       *                 "Message": "Settings not found",
       *                 "Success": false,
       *                 "Status": 404
       *             }
       *         )
       *     )
       * )
       */
      public function index() {}
}
