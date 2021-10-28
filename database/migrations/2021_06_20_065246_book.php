<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Book extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('book', function (Blueprint $table) {
            $table->increments('Id_Book');
            $table->string('Name_Book', 50)->unique();

            $table->unsignedInteger('Id_Subject');
             $table->foreign('Id_Subject')->references('Id_Subject')->on('Subject');

            $table->integer('Amount'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('book');
    }
}
