<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramAccountScrapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_account_scrapes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('instagram_account_id');
            $table->string('username');
            $table->string('full_name')->nullable();
            $table->text('biography')->nullable();
            $table->text('profile_picture_url')->nullable();
            $table->text('external_url')->nullable();
            $table->unsignedInteger('website_id')->nullable();
            $table->unsignedInteger('phone_id')->nullable();
            $table->unsignedSmallInteger('media_count')->default(0);
            $table->unsignedInteger('followers_count')->default(0);
            $table->unsignedInteger('following_count')->default(0);
            $table->unsignedInteger('avg_likes_count')->nullable();
            $table->unsignedInteger('avg_comments_count')->nullable();
            $table->timestamp('avg_dataset_start')->nullable();
            $table->timestamp('avg_dataset_end')->nullable();
            $table->unsignedSmallInteger('avg_dataset_photos_count')->nullable();
            $table->unsignedSmallInteger('avg_dataset_videos_count')->nullable();
            $table->boolean('is_private')->nullable();
            $table->boolean('is_verified')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('set null');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('set null');
            $table->foreign('instagram_account_id')->references('id')->on('instagram_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_account_scrapes');
    }
}
