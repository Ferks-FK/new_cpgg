<?php

namespace App\Jobs;

use App\Contracts\ServerRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class SuspendServerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $serverRepositoryInterface;

    /**
     * Create a new job instance.
     */
    public function __construct(protected int $server_id)
    {
        $this->serverRepositoryInterface = app(ServerRepositoryInterface::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $suspended = $this->serverRepositoryInterface->suspend($this->server_id);

            if (!$suspended) {
                $this->release(60);

                return;
            }

            $rate_limit_remaining = cache()->get('rate_limit_remaining');

            // If the rate limit is less than or equal to 10, release the job for 60 seconds.
            if ($rate_limit_remaining <= 10) {
                $this->release(60);
            }
        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }
    }
}
