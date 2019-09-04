<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('phone_id');
            $table->string('type')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->timestamp('ended_at')->nullable();

            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_logs');
    }
}
