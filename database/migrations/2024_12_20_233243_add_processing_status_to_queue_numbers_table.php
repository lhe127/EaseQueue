<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('queue_numbers', function (Blueprint $table) {
            $table->enum('processing_status', ['pending', 'processing', 'completed'])->default('pending')->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('queue_numbers', function (Blueprint $table) {
            $table->dropColumn('processing_status');
        });
    }
};