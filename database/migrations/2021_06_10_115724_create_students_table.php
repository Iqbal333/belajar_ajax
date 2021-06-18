<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 15);
            $table->string('name', 50);
            $table->date('date_of_birth');
            $table->string('prodi');
            $table->string('faculty', 25);
            $table->string('phone_number', 15);
            $table->string('religion');
            $table->string('email', 20)->unique();
            $table->string('gender');
            $table->text('address');
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
        Schema::dropIfExists('students');
    }
}
