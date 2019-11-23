<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorities', function(BluePrint $table){
            $table->integer('userId')->unsigned();
            $table->boolean('addProduct')->default(0);
            $table->boolean('updateProduct')->default(0);
            $table->boolean('deleteProduct')->default(0);
            $table->boolean('accessReports')->default(0);
            $table->boolean('addUser')->default(0);
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('authorities');
    }
}
