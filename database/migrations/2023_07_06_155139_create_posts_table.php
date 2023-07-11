<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('image1');
            $table->string('image2')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->longText('lead_paragraph');
            $table->longText('table_of_contents');
            $table->longText('content');
            $table->json('tags');
            $table->json('keywords');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
