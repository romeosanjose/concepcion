<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();;
            $table->string('content');
            $table->integer('post_type');
            $table->boolean('is_published');
            $table->boolean('is_active');
            $table->timestamps();
        });
        
         DB::table('post')->insert(
        [
            'title' => 'Sample Post',
            'content' => 'Sample Post Content',
            'post_type' => 1,
            'is_published'=> true,
            'is_active'=> true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post');
    }
}
