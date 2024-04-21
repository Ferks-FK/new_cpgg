<?php

namespace App\Jobs;

use App\Contracts\ServerRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateServerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $serverRepositoryInterface;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $server_id,
        protected mixed $product)
    {
        $this->serverRepositoryInterface = app(ServerRepositoryInterface::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $server_data = ['cpu', 'memory', 'swap', 'disk', 'io', 'databases', 'allocations', 'backups'];

        $values = [];

        foreach ($this->product->toArray() as $column => $value) {
            if (in_array($column, ['databases', 'allocations', 'backups'])) {
                $values['feature_limits'][$column] = $value;
            } elseif (in_array($column, $server_data)) {
                $values[$column] = $value;
            }
        }

        $server_allocation = $this->serverRepositoryInterface->findById($this->server_id)['allocation'];

        $values['allocation'] = $server_allocation;

        $this->serverRepositoryInterface->updateBuild($this->server_id, $values);
    }
}
