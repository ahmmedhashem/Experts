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
            $table->increments('id');
            $table->integer('emirate_id')->unsigned();
            $table->integer('nationality_id')->unsigned();
            $table->string('name');
            $table->integer('type');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('gender');
            $table->date('date_of_birth');

            $table->string('phone');
            $table->string('alt_phone');
            $table->string('current_location');
            $table->string('institution');
            $table->boolean('willing_to_study');
            $table->boolean('willing_to_consultancy');
            $table->boolean('available_to_request');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('emirate_id')->references('id')->on('emirtes')->onDelete('cascade');
            $table->foreign('nationality_id')->references('id')->on('countries')->onDelete('cascade');
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
