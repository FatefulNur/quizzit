<?php

namespace App\Console\Commands;

use App\Models\Plan;
use App\Services\Externals\Lemonsqueezy;
use Illuminate\Console\Command;

class GeneratePlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate available plans for subscription.';

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

        if (Plan::count()) {
            $this->newLine();
            return $this->info('You already have existing plans.');
        }

        $this->newLine();

        $plansList = $response->collect('data');
        foreach ($plansList as $key => $item) {
            $plan = collect($item['attributes'])->only([
                'name',
                'slug',
                'description',
                'status',
                'price',
                'price_formatted',
                'buy_now_url',
            ])->toArray();

            $plan = Plan::create([
                'identity' => $item['id'],
                ...$plan,
            ]);
            $this->line(($key + 1) . ". {$plan->name} created.");
        }

        $this->newLine();
        $this->info("All plans has been generated!");
    }
}
