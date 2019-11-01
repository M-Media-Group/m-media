<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('alias')->unique();
            $table->string('address')->unique();
            $table->ipAddress('last_ip')->nullable();
            $table->ipAddress('last_internal_ip')->nullable();
            $table->string('service_title')->nullable();
            $table->string('georegion')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_servicable')->default(1);
            $table->timestamp('last_contact_at')->useCurrent();
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
        Schema::dropIfExists('bots');
    }
}
