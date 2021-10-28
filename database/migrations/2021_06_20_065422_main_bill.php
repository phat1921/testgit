<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('billMain', function (Blueprint $table) {
             $table->increments('Id_Bill_Main');
    
             $table->unsignedInteger('Id_Class');
             $table->foreign('Id_Class')->references('Id_Class')->on('classroom');
            
            $table->dateTime('Time');
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
        Schema::dropIfExists('billMain');
    }
}
