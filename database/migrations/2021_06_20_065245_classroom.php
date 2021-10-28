<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Classroom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom', function (Blueprint $table) {
            $table->increments('Id_Class');
            $table->string('Name_Class', 8)->unique();

             $table->unsignedInteger('Id_Course');
             $table->foreign('Id_Course')->references('Id_Course')->on('Course');
            
             $table->unsignedInteger('Id_Subject');
             $table->foreign('Id_Subject')->references('Id_Subject')->on('Subject');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom');
    }
}
