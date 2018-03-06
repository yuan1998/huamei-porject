<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author')->nullable()->comment("author");
            $table->string("title")->comment('Article TItle');
            $table->text('content')->comment('Article Content');
            $table->string("status")->default("show")->comment('Article Status');
            $table->integer('level')->default(0)->comment('article Level');
            $table->unsignedInteger('cat_id')->comment("article in cat id");
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
        Schema::dropIfExists('articles');
    }
}
