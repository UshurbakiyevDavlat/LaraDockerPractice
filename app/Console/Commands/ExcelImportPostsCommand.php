<?php

namespace App\Console\Commands;

use App\Imports\PostImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportPostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:excelImportPosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing posts with help of excel';

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        Excel::import(new PostImport(), public_path('excel/Posts.xlsx'));
        echo 'finish import successfully!';
    }
}
