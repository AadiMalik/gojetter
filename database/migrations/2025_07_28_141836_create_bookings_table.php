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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('booking_date')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->integer('adults')->default(0);
            $table->integer('children')->default(0);
            $table->integer('total_participants')->default(0);
            $table->decimal('sub_total',18,2)->default(0);
            $table->decimal('tax_percent',18,2)->default(0);
            $table->decimal('tax_amount',18,2)->default(0);
            $table->decimal('discount',18,2)->default(0);
            $table->decimal('total',18,2)->default(0);
            $table->string('payment_method')->nullable();
            $table->integer('card_id')->nullable();
            $table->string('currency')->nullable();
            $table->integer('coupon_id')->nullable();

            $table->enum('status',['pending','confirmed','paid','rejected','completed','refunded','no_show','canceled'])->default('pending');
            $table->boolean('is_deleted')->default(0);
            $table->integer('createdby_id')->nullable();
            $table->integer('updatedby_id')->nullable();
            $table->integer('deletedby_id')->nullable();
            $table->timestamp('date_deleted')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
