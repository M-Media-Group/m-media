<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('internship_id')->unique();
            $table->unsignedInteger('file_id')->unique();
            $table->uuid('uuid')->unique();
            $table->string('personal_message_title');
            $table->text('personal_message_body');
            $table->boolean('congratulations_page_is_public')->default(1);
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('internship_id')->references('id')->on('internships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_certificates');
    }
}
