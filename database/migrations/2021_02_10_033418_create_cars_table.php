<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('address_id');
            $table->integer('rule_id')->nullable();
            $table->string('license_plates');
            $table->tinyInteger('seats');
            $table->tinyInteger('type_of_fuel');
            $table->tinyInteger('actions');
            $table->tinyInteger('fuel_consumption')->nullable();
            $table->timestamp('year_of_product');
            $table->float('price');
            $table->float('discount')->nullable();
            $table->tinyInteger('limited_km');
            $table->tinyInteger('limit_pass_fee');
            $table->string('car_rental_terms')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
