<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\Externals\Lemonsqueezy;
use Illuminate\Console\Command;

class GenerateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate available products for subscription.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newLine();
        $this->info('Generating.....');

        $response = Lemonsqueezy::getProducts();

        if ($response->failed()) {
            $this->newLine();
            return $this->error('Cannot be processed of current request.');
        }

        if (Product::count()) {
            $this->newLine();
            return $this->info('You already have existing products.');
        }

        $this->newLine();

        $productsList = $response->collect('data');
        foreach ($productsList as $key => $item) {
            $product = collect($item['attributes'])->only([
                'name',
                'slug',
                'description',
                'status',
                'price',
                'price_formatted',
                'buy_now_url',
            ])->toArray();

            $product = Product::create([
                'identity' => $item['id'],
                ...$product,
            ]);
            $this->line(($key + 1) . ". {$product->name} created.");
        }

        $this->newLine();
        $this->info("All products has been generated!");
    }
}
