<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('queue_limit');
            $table->integer('limit_of_call');
            $table->string('notification_time');
            $table->string('open_time_from');
            $table->string('open_time_to');
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
        Schema::dropIfExists('queue_settings');
    }
};
