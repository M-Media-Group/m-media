<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->string('from_display')->nullable();
            $table->unsignedInteger('email_id');
            $table->unsignedInteger('reply_to_email_id')->nullable();
            $table->unsignedInteger('to_email_id');
            $table->string('aws_message_id')->nullable();
            $table->string('status')->nullable();
            $table->string('subject')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
            $table->foreign('reply_to_email_id')->references('id')->on('emails')->onDelete('set null');
            $table->foreign('to_email_id')->references('id')->on('emails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_logs');
    }
}
