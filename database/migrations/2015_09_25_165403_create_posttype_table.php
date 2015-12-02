<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosttypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();;
            $table->string('description');
            $table->timestamps();
        });
        
         DB::table('post_type')->insert(
                 array(
                     array('name' => 'news',
                           'description' => 'news and articles'),
                     array('name' => 'hirings',
                            'description' => 'hiring and latest jobs')
                 )
       );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_type');
    }
}
