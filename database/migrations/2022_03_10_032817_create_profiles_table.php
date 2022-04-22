<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('address');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('dob');
            $table->string('jobtitle');
            $table->string('jobtype');
            $table->integer('category');
            $table->string('salary');
            $table->string('skill');
            $table->integer('experience');
            $table->string('cover_letter');
            $table->string('resume');
            $table->string('avatar');
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
        Schema::dropIfExists('profiles');
    }
}
