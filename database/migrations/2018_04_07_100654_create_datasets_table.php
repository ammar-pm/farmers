<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->string('preview')->nullable();
            $table->integer('public')->nullable();
            $table->integer('featured')->nullable();
            $table->string('language')->nullable();
            $table->string('tags')->nullable();
            $table->string('library')->nullable();
            $table->longtext('options')->nullable();
            $table->integer('created_by');
            $table->timestamps();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasets');
    }
}
