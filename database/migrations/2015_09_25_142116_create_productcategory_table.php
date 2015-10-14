<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_code');
            $table->string('category_name');
            $table->string('category_desc');
            $table->boolean('is_active');
            $table->timestamps();
        });
        
        DB::table('product_category')->insert(
        [
            'category_name' => 'Sliding Door Section',
            'category_desc' => 'Sliding Door Section desc',
            'category_code' => 'SD',
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
        Schema::drop('product_category');
    }
}
