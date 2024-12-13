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
    Schema::table('staff', function (Blueprint $table) {
        $table->boolean('is_admin')->default(false); // Add is_admin with a default value
    });
}

public function down()
{
    Schema::table('staff', function (Blueprint $table) {
        if (Schema::hasColumn('staff', 'is_admin')) {
            $table->dropColumn('is_admin');
        }
    });
}

};
