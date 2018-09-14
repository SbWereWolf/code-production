<?php

namespace App\Jobs;

use App\CardPr\Business\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class StoreLetter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $letter = '';

    /**
     * Create a new job instance.
     *
     * @param Letter $letter
     */
    public function __construct(Letter $letter)
    {
        $this->letter = $letter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();

        try {

            $message = \App\CardPr\Table\Message::create(
                array(
                    'content' => $this->letter->getContent(),
                    'author' => $this->letter->getAuthor(),
                    'created_at' => time(),
                )
            );

            $isSuccess = ($message->exists);


        } catch (\Exception $e) {
            dd($e);
            $isSuccess = false;
        }

        if (!$isSuccess) {
            DB::rollback();
        }
        if ($isSuccess) {
            DB::commit();
        }
    }
}
