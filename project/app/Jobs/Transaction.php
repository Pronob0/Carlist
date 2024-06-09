<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Transaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $transaction = new \App\Models\Transaction();
        $transaction->trnx = $this->data['txn_number'];
        $transaction->user_id = $this->data['user_id'];
        $transaction->amount = $this->data['amount'];
        $transaction->charge = $this->data['charge'];
        $transaction->currency_id= $this->data['currency_id'];
        $transaction->type = $this->data['type'];
        $transaction->remark = $this->data['remark'];
        $transaction->details = $this->data['details'];
        $transaction->save();
        
        
    }
}
