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
        Schema::create('queue_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->foreignId('counter_id')->constrained()->onDelete('cascade');
            $table->string('staffID')->nullable(); // Match the type of staff.staffID
            $table->foreign('staffID')->references('staffID')->on('staff')->onDelete('cascade'); // Define the foreign key relationship
            $table->integer('queue_number');
            $table->boolean('is_served')->default(0);
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->timestamp('service_start_time')->nullable();
            $table->timestamp('service_end_time')->nullable();
            $table->timestamps("Asia/Kuala_Lumpur");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queue_numbers', function (Blueprint $table) {
            if (Schema::hasColumn('queue_numbers', 'customer_id')) {
                $table->dropForeign(['customer_id']);
                $table->dropColumn('customer_id');
            }
             if (Schema::hasColumn('queue_numbers', 'staff_staffID')) {
                $table->dropForeign(['staff_staffID']);
                $table->dropColumn('staff_staffID');
            }
        });
        
        Schema::dropIfExists('queue_numbers');
    }
};
