<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('student', function (Blueprint $table) {
            $table->increments('Id_Student');
            $table->string('Name_Name', 100);
            $table->tinyinteger('Gender');
            $table->date('DoB');
            $table->string('Email', 100)->unique();
            $table->string('Phone_Number',10)->unique();
             $table->unsignedInteger('Id_Class');
             $table->foreign('Id_Class')->references('Id_Class')->on('classroom');
 
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
