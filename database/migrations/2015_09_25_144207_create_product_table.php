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
            $table->string('product_name');
            $table->string('product_desc');
            $table->string('product_code');
            $table->integer('category_id');
            $table->float('price');
            $table->float('gross_price');
            $table->decimal('size1',6,2);
            $table->decimal('size2',6,2);
            $table->decimal('size3',6,2);
            $table->decimal('size4',6,2);
            $table->integer('pre_stocks');
            $table->integer('stocks');  
            $table->string('is_active');
            $table->timestamps();
        });
        
         DB::table('product')->insert(
        [
            'product_name' => 'Door 1 Slide',
            'product_desc' => 'Mini Sliding Door Section',
            'product_code' => 'SD-01',
            'category_id' => 1,
            'price' => 14.0,
            'gross_price' => 15.0,
            'size1' => 15.10,
            'size2' => 15.10,
            'size3' => 15.10,
            'size4' => 15.10,
            'pre_stocks' => 60,
            'stocks' => 50,
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
