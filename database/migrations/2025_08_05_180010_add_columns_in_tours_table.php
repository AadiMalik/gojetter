<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("UPDATE tours SET tour_type = NULL WHERE tour_type NOT IN ('private', 'group')");
        DB::statement("ALTER TABLE tours MODIFY tour_type ENUM('private', 'group') NULL");
        Schema::table('tours', function (Blueprint $table) {
            $table->string('tags')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->text('highlights')->nullable();
            $table->enum('difficulty_level', ['easy', 'moderate', 'challenging', 'hard', 'expert'])->default('easy');
            $table->integer('age_limit')->nullable();
            $table->string('pickup_info')->nullable();
            $table->string('dropoff_info')->nullable();
            $table->dropColumn('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE tours MODIFY tour_type ENUM('Tour', 'Activity') NULL");
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['tags', 'is_featured', 'highlights', 'difficulty_level', 'age_limit', 'pickup_info', 'dropoff_info']);
            $table->decimal('price', 18, 2)->default(0);
        });
    }
};
