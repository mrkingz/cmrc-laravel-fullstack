<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->unique();
            $table->unsignedInteger('field');
            $table->unsignedInteger('type');
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
        Schema::dropIfExists('educational_services');
    }
}
