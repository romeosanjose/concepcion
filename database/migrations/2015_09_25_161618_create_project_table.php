<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name');
            $table->string('project_desc');
            $table->boolean('is_public');
            $table->boolean('is_active');
            $table->timestamps();
        });
        
         DB::table('project')->insert(
        [
            'project_name' => 'SM Super Market',
            'project_desc' => 'SM super market DASMA',
            'is_public'=> true,
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
        Schema::drop('project');
    }
}
