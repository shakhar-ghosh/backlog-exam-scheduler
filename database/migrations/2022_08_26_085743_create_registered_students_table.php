<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('roll');
            $table->string('name',250);
            $table->string('registration', 250);
            $table->integer('examid');
            $table->boolean('verified')->default(false);
            $table->integer('course1')->nullable();
            $table->integer('course2')->nullable();
            $table->integer('course3')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registered_students');
    }
};
