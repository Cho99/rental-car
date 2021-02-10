<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_list');
            $table->integer('car_id');
            $table->string('car_registrations')->nullable();
            $table->string('registry')->nullable();
            $table->string('insurance')->nullable();
            $table->string('previous')->nullable();
            $table->string('behind')->nullable();
            $table->string('right')->nullable();
            $table->string('left')->nullable();
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
        Schema::dropIfExists('images');
    }
}
