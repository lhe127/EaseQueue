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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('staffID'); // Match the type of staff.staffID
            $table->foreign('staffID')->references('staffID')->on('staff')->onDelete('cascade'); // Define the foreign key relationship
            $table->string('requestType');
            $table->string('image')->nullable();
            $table->date('Fdate');
            $table->date('Tdate');
            $table->text('reason');
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
        Schema::dropIfExists('contacts');
    }
};
