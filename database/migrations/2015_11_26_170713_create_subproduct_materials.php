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
            $table->boolean('is_active');
            $table->timestamps();
        });

        DB::table('sub_product_material')->insert(
            [
                'sub_product_id' => 1,
                'material_id' => 1,
                'is_active' => true
            ]);
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
