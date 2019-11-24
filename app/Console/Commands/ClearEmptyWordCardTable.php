<?php

namespace App\Console\Commands;

use App\Models\WordCardWord;
use Illuminate\Console\Command;

class ClearEmptyWordCardTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word_card:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear empty ref in word_card_word table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        WordCardWord::where('card_id', '=', '')->delete();
    }
}
