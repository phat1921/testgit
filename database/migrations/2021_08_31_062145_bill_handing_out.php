<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BillHandingOut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billHO', function (Blueprint $table) {
             $table->increments('Id_BillHO');
             $table->unsignedInteger('Id_Student');
             $table->foreign('Id_Student')->references('Id_Student')->on('student'); 
             
             $table->unsignedInteger('Id_Class');
             $table->foreign('Id_Class')->references('Id_Class')->on('classroom');

             $table->unsignedInteger('Id_Book');
             $table->foreign('Id_Book')->references('Id_Book')->on('book');
    
            $table->dateTime('Time'); 
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billHO');
    }
}
