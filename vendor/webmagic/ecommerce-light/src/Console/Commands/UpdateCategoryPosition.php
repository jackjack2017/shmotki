<?php

namespace Webmagic\EcommerceLight\Console\Commands;

use Illuminate\Console\Command;
use Webmagic\EcommerceLight\Ecommerce;


class UpdateCategoryPosition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:category:update-position {moved_entity_id} {type} {base_entity_id} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update category position';

    /**
     * Name of services
     *
     * @var Ecommerce
     */
    protected $ecommerce;

    /**
     * Create a new command instance.
     *
     * @param Ecommerce $ecommerce
     * @internal param CurrencyService $currencyService
     */
    public function __construct(Ecommerce $ecommerce)
    {
        parent::__construct();
        $this->ecommerce = $ecommerce;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->argument('type') === 'before'){
            $this->ecommerce->categoryMoveBefore($this->argument('moved_entity_id'), $this->argument('base_entity_id'));
        } else {
            $this->ecommerce->categoryMoveAfter($this->argument('moved_entity_id'), $this->argument('base_entity_id'));
        }

        $this->info('Done');

    }
}
