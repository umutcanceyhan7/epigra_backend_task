<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceXTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_x', function (Blueprint $table) {
            $table->id();
            $table->string('capsule_serial');
            $table->string('capsule_id');
            $table->string('status');
            $table->string('original_launch');
            $table->integer('original_launch_unix');
            $table->string('missions');
            $table->string('landings');
            $table->string('type');
            $table->text('details');
            $table->integer('reuse_count');
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
        Schema::dropIfExists('space_x');
    }
}
