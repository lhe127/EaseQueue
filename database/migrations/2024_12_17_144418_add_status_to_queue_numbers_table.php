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
        Schema::table('queue_numbers', function (Blueprint $table) {
            $table->string('status')->default('active'); 
        });
    }

    public function down()
    {
        Schema::table('queue_numbers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
