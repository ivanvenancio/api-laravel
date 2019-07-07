<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifiers', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('name');
            $table->string('last_name');
            $table->char('cpf',11)->unique();
            $table->string('profession');
            $table->date('date-birth');
            $table->char('phone',13);
            $table->string('zip_code',8);
            $table->char('state',2);
            $table->string('city');
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
        Schema::dropIfExists('specifiers');
    }
}
