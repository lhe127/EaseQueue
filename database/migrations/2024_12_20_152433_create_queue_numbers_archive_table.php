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
        Schema::create('queue_numbers_archive', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable();
            $table->foreignId('counter_id')->nullable();
            $table->string('staffID')->nullable();
            $table->integer('queue_number');
            $table->boolean('is_served')->default(0);
            $table->foreignId('customer_id')->nullable();
            $table->timestamp('service_start_time')->nullable();
            $table->timestamp('service_end_time')->nullable();
            $table->string('status')->default('active');
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
        Schema::dropIfExists('queue_numbers_archive');
    }
};
