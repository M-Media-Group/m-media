<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_accounts', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('username');
            $table->string('instagram_id')->unique()->nullable();
            $table->string('buffer_id')->unique()->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('is_scrapeable')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_accounts');
    }
}
