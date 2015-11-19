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
            $table->timestamps();
        });

        DB::table('product_material')->insert(
            [
                'product_id' => 1,
                'material_id' => 11,
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
