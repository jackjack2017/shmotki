<?php

namespace Webmagic\Dashboard\Console\Commands;

use Illuminate\Console\Command;

class Publish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lc:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishing all public resources from installed WebmagicCMS modules';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Publish all dashboard module resources
        $this->call('vendor:publish', [
            '--provider' => 'Webmagic\Dashboard\DashboardServiceProvider'
            ]);

        $this->info('Publishing finished!');
    }
}
