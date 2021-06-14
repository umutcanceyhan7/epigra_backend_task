<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceXApiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_x_api_models', function (Blueprint $table) {
            $table->id();
            $table->string('capsule_serial')->nullable(); #
            $table->string('capsule_id')->nullable(); #
            $table->string('status')->nullable(); #
            $table->string('original_launch')->nullable();
            $table->integer('original_launch_unix')->nullable();
            $table->string('missions')->nullable(); #
            $table->string('landings')->nullable(); #
            $table->string('type')->nullable(); #
            $table->text('details')->nullable();
            $table->integer('reuse_count')->nullable(); #
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
        Schema::dropIfExists('space_x_api_models');
    }
}
