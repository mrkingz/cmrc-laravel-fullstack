<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name')->unique();
            $table->integer('resource_id')->unsigned();
            //$table->string('extension');
            $table->timestamps();
            
            $table->engine = 'InnoDB';

            $table->foreign('resource_id')
                  ->references('id')->on('resources')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_files');
    }
}
