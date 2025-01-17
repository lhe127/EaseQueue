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
        Schema::table('queue_numbers_archive', function (Blueprint $table) {
            //
            $table->timestamp('min_wait_start_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queue_numbers_archive', function (Blueprint $table) {
            //
            $table->dropColumn('min_wait_start_time'); 
        });
    }
};
