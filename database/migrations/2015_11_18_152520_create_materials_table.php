<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material_name')->unique();;
            $table->string('material_desc');
            $table->string('material_categ_id');
            $table->string('material_code');
            $table->float('price');
            $table->float('gross_price');
            $table->decimal('size',6,2);
            $table->string('is_active');
            $table->timestamps();
        });

        DB::table('material')->insert(
            [
                'material_name' => 'Sample Material',
                'material_desc' => 'Sample Material Description',
                'material_categ_id' => 1,
                'material_code'=>'YD-01',
                'price' => 14.0,
                'gross_price' => 15.0,
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
        Schema::drop('material');
    }
}
