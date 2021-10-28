<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('Id_Admin');
            $table->String('Name_Admin', 100);
            $table->Date('DoB');
            $table->tinyinteger('Gender');
            $table->String('Phone_Number', 10)->unique();
            $table->String('Address', 200); 
            $table->String('Email', 150)->unique();
            $table->String('User_Name', 15)->unique();
            $table->String('PassWord', 15);
            $table->tinyinteger('Role');
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
        Schema::dropIfExists('admin');
    }
}
