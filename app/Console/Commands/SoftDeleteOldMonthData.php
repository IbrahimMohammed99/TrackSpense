<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Console\Command;

class SoftDeleteOldMonthData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:soft-delete-old-month-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $previousMonth = now()->subMonth()->format('Y-m');


        Expense::where('month', $previousMonth)->delete();


        Income::where('month', $previousMonth)->delete();

        $this->info("Soft deleted data for month $previousMonth");
    }
}
