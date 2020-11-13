<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authentication_events', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('user_id')->nullable();

            $table->unsignedInteger('email_id')->nullable();

            $table->string('event')->nullable();

            $table->string('guard')->nullable();

            $table->string('device')->nullable();
            $table->string('device_version')->nullable();

            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();

            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();

            $table->json('browser_languages')->nullable();

            $table->ipAddress('ip')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('email_id')->references('id')->on('emails')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authentication_events');
    }
}
