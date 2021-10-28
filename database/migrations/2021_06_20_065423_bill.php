<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
             $table->increments('Id_Bill');

             $table->unsignedInteger('Id_Bill_Main');
             $table->foreign('Id_Bill_Main')->references('Id_Bill_Main')->on('billmain');

             $table->unsignedInteger('Id_Student');
             $table->foreign('Id_Student')->references('Id_Student')->on('student'); 

             $table->unsignedInteger('Id_Book');
             $table->foreign('Id_Book')->references('Id_Book')->on('book');

            $table->tinyinteger('Status'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('bill');
    }
}
