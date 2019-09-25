<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpiricalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empirical_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->unique();
            $table->unsignedInteger('target');
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');
            $table->engine = 'InnoDB';
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
        Schema::dropIfExists('empirical_data');
    }
}
