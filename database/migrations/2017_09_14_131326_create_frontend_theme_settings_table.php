<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendThemeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_theme_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('selected_theme',['cerulean','cosmo','cyborg','darkly','flatly','spacelab','superhero','united','yeti','custom','minty'])->default('cerulean');
            $table->enum('navbar_style',['none','default','inverse'])->default('inverse');
            $table->boolean('navbar_container_fluid')->default(1);
            $table->boolean('body_container_fluid')->default(1);
            $table->boolean('breadcrumb')->default(1);
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
        Schema::dropIfExists('frontend_theme_settings');
    }
}
