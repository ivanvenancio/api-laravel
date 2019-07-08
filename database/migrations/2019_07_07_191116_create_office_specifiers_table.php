<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeSpecifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_specifiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('office_id')->nullable($value = false);            
            $table->foreign('office_id')
                ->references('id')->on('offices')
                ->onDelete('cascade');

            $table->unsignedBigInteger('specifier_id')->nullable($value = false);            
            $table->foreign('specifier_id')
                ->references('id')->on('specifiers')
                ->onDelete('cascade');
            $table->string('status')->default('yes');
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
        Schema::dropIfExists('office_specifiers');
    }
}
