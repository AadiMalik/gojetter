<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('tab_logo')->nullable();
            $table->string('admin_panel_logo')->nullable();
            $table->string('mobile_application_logo')->nullable();
            $table->string('mobile_application_home_image')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('website_page_image')->nullable();
            $table->string('support_email')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
