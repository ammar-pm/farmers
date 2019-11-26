<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGovernoratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('governorates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->integer('sort')->nullable();
            $table->string('language')->nullable();
            $table->longtext('geojson')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('governorates');
    }
}
