<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material_categ_name')->unique();;
            $table->string('material_categ_desc');
            $table->boolean('is_active');
            $table->timestamps();
        });

        DB::table('material_category')->insert(
            [
                'material_categ_name' => 'Sample Material Category',
                'material_categ_desc' => 'Sample Material cateogry Description',
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
        Schema::drop('material_category');
    }
}
