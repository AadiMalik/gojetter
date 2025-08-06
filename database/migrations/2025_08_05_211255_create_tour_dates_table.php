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
        Schema::create('tour_dates', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('price',18,2)->default(0);
            $table->decimal('discount_price',18,2)->default(0);
            $table->enum('price_type', ['per_person', 'per_group']);
            
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
        Schema::dropIfExists('tour_dates');
    }
};
