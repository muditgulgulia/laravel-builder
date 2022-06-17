<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderConfigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slider_id');
            $table->string('full_image');
            $table->string('thumbnail');
            $table->string('caption_text');
            $table->string('caption_location');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('slider_configrations');
    }
}
