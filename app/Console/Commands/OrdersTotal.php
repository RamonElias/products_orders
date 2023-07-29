<?php

namespace App\Console\Commands;

use App\Jobs\SumOrdersTotal;
use App\Models\Record;
use Illuminate\Console\Command;

class OrdersTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:orders-total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns the sum of all product orders in the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new SumOrdersTotal());
        sleep(2);

        $record = Record::latest()->first();

        while ($record == null) {
            $this->error('Remember execute jobs in queue with this command ->');
            $this->info('php artisan queue:work');
            $this->newLine();

            sleep(2);

            $record = Record::latest()->first();
        }

        $orders_total_sum = $record->get()[0]->orders_total_sum;

        // $this->info('Check this endpoint to see the sum total of product orders updated -> /total');
        $this->info('The sum total of product orders is: '.$orders_total_sum.' $USD');
    }
}
