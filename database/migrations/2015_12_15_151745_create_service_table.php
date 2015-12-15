<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_name');
            $table->boolean('is_active');
            $table->timestamps();
        });

        DB::table('service')->insert(
            array(
                array('service_name'=>'Skylight polycarbonate','is_active'=> true),
                array('service_name'=>'Arcylic plastic','is_active'=> true),
                array('service_name'=>'Store front section & patch fitting for doors & windows','is_active'=> true),
                array('service_name'=>'Sliding doors & windows','is_active'=> true),
                array('service_name'=>'Glass etching tempered glass safety glass top glass bevelled glass face mirror alum','is_active'=> true),
                array('service_name'=>'Screen for doors windows frameless doors','is_active'=> true)

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
