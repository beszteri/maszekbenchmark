<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cpu_id');
            $table->integer('vga_id');
            $table->integer('ram_id');
            $table->integer('ssd1_id');
            $table->integer('ssd2_id');
            $table->integer('ssd3_id');
            $table->integer('ssd4_id');
            $table->integer('ssd5_id');
            $table->integer('hdd1_id');
            $table->integer('hdd2_id');
            $table->integer('hdd3_id');
            $table->integer('hdd4_id');
            $table->integer('hdd5_id');
            $table->float('gamer_score');
            $table->float('desktop_score');
            $table->float('workstation_score');
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
        Schema::dropIfExists('computers');
    }
}
