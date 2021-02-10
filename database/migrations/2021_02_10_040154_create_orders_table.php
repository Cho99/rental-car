<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('car_id');
            $table->decimal('price', 9, 3);
            $table->decimal('service_charge', 9, 3);
            $table->float('discount')->nullable();
            $table->date('borrowed_date');
            $table->time('borrowed_time');
            $table->date('return_date');
            $table->time('return_time');
            $table->string('address');
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
        Schema::dropIfExists('orders');
    }
}
