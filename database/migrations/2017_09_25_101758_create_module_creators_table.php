<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_creators', function (Blueprint $table) {
            $table->increments('id');

            $table->string('module_name');
            $table->text('migration_fields')->nullable();
            $table->string('make_migration')->default('no');
            $table->string('controller_related_to')->default('Admin');
            $table->boolean('active')->default(0);

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
        Schema::dropIfExists('module_creators');
    }
}
