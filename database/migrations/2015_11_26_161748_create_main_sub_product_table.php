<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainSubProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_sub_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
            $table->string('sub_product_id');
            $table->timestamps();
        });

        DB::table('main_sub_product')->insert(
            array(
                array(
                    'product_id' => 1,
                    'sub_product_id' => 1,
                ),
                array(
                    'product_id' => 1,
                    'sub_product_id' => 2,
                ),
                array(
                    'product_id' => 1,
                    'sub_product_id' => 3,
                ),
                array(
                    'product_id' => 1,
                    'sub_product_id' => 4,
                )
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
        Schema::drop('main_sub_product');
    }
}
