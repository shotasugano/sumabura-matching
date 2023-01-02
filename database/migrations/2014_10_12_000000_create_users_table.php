<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('twitter_id')->nullable();
            $table->string('access_token')->nullable();
            $table->string('name');
            $table->rememberToken();
            $table->string('charaname')->nullable();
            $table->string('denychara')->nullable();
            $table->string('rate')->nullable();
            $table->string('denyrate')->nullable();
            $table->integer('role')->nullable();
            $table->string('path')->nullable();
            $table->string('address')->nullable();
            $table->string('playdate')->nullable();
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
        Schema::dropIfExists('users');
    }
}
