<?php

namespace App\Jobs\GenerateCatalog;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCatalogMainJob extends AbstractJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->debug('start');

        GenerateCatalogCacheJob::dispatchNow();

        $chainPrices = $this->getChainPrices();

        $chainMain = [
            new GenerateCategoriesJob,
            new GenerateDeliveriesJob,
            new GeneratePointsJob,
        ];

        $chainLast = [
            new ArchiveUploadsJob,
            new SendPricesRequestJob,
        ];

        $chain = array_merge($chainPrices,$chainMain,$chainLast);

        GenerateGoodsFileJob::withChain($chain)->dispatch();

        $this->debug('finish');

    }

    /**
     * @return array
     */
    private function getChainPrices(): array
    {
        $result = [];
        $products = collect([1,2,3,4,5]);

        $fileNum = 1;

        foreach ($products->chunk(1) as $chunk){
            $result[] = new GeneratePricesFileChunkJob($chunk,$fileNum);
            $fileNum++;
        }

        return $result;
    }
}
