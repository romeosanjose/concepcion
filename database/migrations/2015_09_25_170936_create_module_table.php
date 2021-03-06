<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_name')->unique();;
            $table->timestamps();
        });
        
        DB::table('module')->insert(
            array(
                array('module_name' => 'project'),
                array('module_name' => 'product'),
                array('module_name' => 'post'),
                array('module_name' => 'material'),
                array('module_name' => 'home'),
                array('module_name' => 'sub_product')
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
        Schema::drop('module');
    }
}
