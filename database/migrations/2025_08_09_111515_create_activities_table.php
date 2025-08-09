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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->longText('overview')->nullable();
            $table->text('short_description')->nullable();
            $table->text('highlights')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('tags')->nullable();
            $table->integer('category_id')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->enum('difficulty_level', ['easy', 'moderate', 'challenging', 'hard', 'expert'])->default('easy');
            $table->integer('age_limit')->nullable();
            $table->string('pickup_info')->nullable();
            $table->string('dropoff_info')->nullable();
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->string('languages')->nullable();
            $table->integer('min_adults')->nullable();
            $table->integer('group_size')->nullable();
            $table->enum('activity_type',['private', 'group'])->default('group');
            $table->boolean('is_wheelchair_accessible')->default(0);
            $table->boolean('is_stroller_friendly')->default(0);
            $table->integer('cut_of_day')->default(0);
            $table->text('rules')->nullable();
            $table->text('requirements')->nullable();
            $table->text('disclaimers')->nullable();

            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('activities');
    }
};
