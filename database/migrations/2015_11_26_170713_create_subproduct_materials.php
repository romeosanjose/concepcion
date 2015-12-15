<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubproductMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_product_material', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_product_id');
            $table->integer('material_id');
            $table->float('mat_sub_price');
            $table->boolean('is_active');
            $table->timestamps();
        });

        DB::table('sub_product_material')->insert(
             array(
                array(
                    'sub_product_id' => 1,
                    'material_id' => 1,
                    'mat_sub_price' => 30,
                    'is_active' => true
                ),
                array(
                    'sub_product_id' => 2,
                    'material_id' => 1,
                    'mat_sub_price' => 40,
                    'is_active' => true
                ),
                array(
                    'sub_product_id' => 3,
                    'material_id' => 1,
                    'mat_sub_price' => 50,
                    'is_active' => true
                ),
                array(
                    'sub_product_id' => 4,
                    'material_id' => 1,
                    'mat_sub_price' => 60,
                    'is_active' => true
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
        Schema::drop('sub_product_material');
    }
}
