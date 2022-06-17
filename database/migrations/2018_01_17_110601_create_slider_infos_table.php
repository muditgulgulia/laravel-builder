<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slider_name')->unique();
            $table->boolean('status')->default(0);
            $table->string('style');
            $table->string('active_class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slider_infos');
    }
}
