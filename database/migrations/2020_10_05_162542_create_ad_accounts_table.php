<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ad_account_platform_id')->nullable();
            $table->string('external_account_id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('is_managed')->default(1);
            $table->timestamps();

            $table->foreign('ad_account_platform_id')->references('id')->on('ad_account_platforms')->onDelete('set null');
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
        Schema::dropIfExists('ad_accounts');
    }
}
