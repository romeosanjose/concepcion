<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->unique();;
            $table->longText('product_desc');
            $table->string('product_code');
            $table->integer('category_id');
            $table->float('price');
            $table->decimal('size',6,2);
            $table->string('is_active');
            $table->timestamps();
        });
        
         DB::table('product')->insert(
        [
            'product_name' => 'Sample Product',
            'product_desc' => 'Sample Product Description',
            'product_code' => 'SD-01',
            'category_id' => 1,
            'price' => 14.0,
            'size' => 15.10,
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
        Schema::drop('product');
    }
}
