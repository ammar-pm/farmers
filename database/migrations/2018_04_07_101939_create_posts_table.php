<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longtext('subline')->nullable();
            $table->longtext('summary')->nullable();
            $table->longtext('description')->nullable();
            $table->string('language')->nullable();
            $table->integer('public')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('comments')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
