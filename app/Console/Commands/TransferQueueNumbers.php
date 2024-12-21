<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransferQueueNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer queue_numbers data to archive and reset the table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Start the transaction
            DB::beginTransaction();

            // Fetch data from queue_numbers
            $queueNumbers = DB::table('queue_numbers')->get();

            // Convert the collection to an array of arrays for insertion, excluding 'id'
            $queueNumbersArray = $queueNumbers->map(function ($item) {
                unset($item->id); // Exclude the 'id' field
                return (array) $item;
            })->toArray();

            // Insert the data into the archive table
            DB::table('queue_numbers_archive')->insert($queueNumbersArray);

            // Commit the transaction first
            DB::commit();

            // Now delete all records from the queue_numbers table after committing
            DB::table('queue_numbers')->delete();

            // Reset the auto-increment value of the 'id' field to 1
            DB::statement('ALTER TABLE queue_numbers AUTO_INCREMENT = 1;');

            $this->info('Data successfully transferred and table reset.');
        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs and the transaction is active
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            // Log the error with details
            Log::error('Error transferring queue numbers: ' . $e->getMessage());
            $this->error('An error occurred: ' . $e->getMessage());

            // Exit after logging the error to halt the process
            exit(1); // Exits the script with a failure status
        }

        return 0;
    }
}
