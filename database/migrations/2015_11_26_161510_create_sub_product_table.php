<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_product_name')->unique();
            $table->string('sub_product_desc');
            $table->float('price');
            $table->decimal('size',6,2);
            $table->string('is_active');
            $table->timestamps();
        });

        DB::table('sub_product')->insert(
            [
                'sub_product_name' => 'Sub Sample Product',
                'sub_product_desc' => 'Sub Sample Product Description',
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
        Schema::drop('sub_product');
    }
}
