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
            $table->string('first_name');
            $table->string('last_name');
            $table->char('cpf',11)->unique();
            $table->string('profession');
            $table->date('date_birth');
            $table->string('phone',13);
            $table->string('zip_code',8);
            $table->char('state',2);
            $table->string('city');
            $table->timestamps();
            $table->engine = 'InnoDB';
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
