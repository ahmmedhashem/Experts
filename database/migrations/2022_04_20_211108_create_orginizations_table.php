<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrginizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orginizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')-> unsigned();
            $table->string('name');
            $table->integer('type');
            $table->text('desc');
            $table->date('start_date');
            $table->date('end_date');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orginizations');
    }
}
