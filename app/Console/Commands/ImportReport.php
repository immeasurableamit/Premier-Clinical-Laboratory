<?php

namespace App\Console\Commands;

use App\Http\Controllers\PackageController;
use Illuminate\Console\Command;

class ImportReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Excel Sheets in Database';

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
     * @return int
     */
    public function handle()
    {
        $PackageController = new PackageController();
        $PackageController->Import();
    }
}
