<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $type;
    protected $info;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(string $type, array $info, object $user)
    {
        $this->type = $type;
        $this->info = $info;
        $this->user = $user;
    }

    public function handle(): void
    {

       @mailSend($this->type, $this->info, $this->user);
    }
}
