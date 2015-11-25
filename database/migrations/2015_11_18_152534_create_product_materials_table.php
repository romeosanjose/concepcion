<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_material', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('material_id');
            $table->boolean('is_active');
            $table->timestamps();
        });

        DB::table('product_material')->insert(
            [
                'product_id' => 1,
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
        Schema::drop('product_material');
    }
}
