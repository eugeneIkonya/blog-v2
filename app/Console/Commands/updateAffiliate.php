<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Affiliate;

class updateAffiliate extends Command
{
    protected $signature = 'affiliate:update-days-left';

    protected $description = 'Update the "days_left" attribute of affiliates.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $affiliates = Affiliate::where('days_left', '>', 0)->get();

        foreach ($affiliates as $affiliate) {
            $affiliate->decrement('days_left');
        }

        $this->info('Affiliates updated successfully.');
    }
}
