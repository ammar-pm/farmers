<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSdmaxCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdmax__codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parent')->nullable();
            $table->string('code');
            $table->longtext('description')->nullable();
            $table->integer('sort')->nullable();
            $table->string('language')->nullable();
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
        Schema::dropIfExists('sdmax__codes');
    }
}
