<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->point('location');

            $table->unsignedInteger('city_id')->nullable();

            $table->boolean('is_public')->default(0);

            $table->unsignedInteger('user_id')->nullable();

            $table->string('notes')->nullable();

            $table->timestamps();

            $table->unique(['location', 'user_id']);
            $table->unique(['address', 'user_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->spatialIndex('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
