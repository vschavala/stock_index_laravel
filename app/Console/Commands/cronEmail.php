<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\StockExport;
use App\Mail\StockMail;
use App\StockIndex;
use Excel;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stck Exported';

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
        
        $today_time = date('d-m-y');
        $export = new StockExport();
        $stcok_indexes = StockIndex::all();

        // Export the data to excel file

        foreach ($stcok_indexes as $key => $index) {
            
            $export->collection($index->id);
           
            $Stock_index_file_name = $index->index_slug.$today_time.'.xlsx';
           
            Excel::store($export, $Stock_index_file_name,'public');
    
        }
        try {
            $user_details = StockIndex::with('user')->get();

            //Send email to each user individually

            foreach ($user_details as $key => $user) {
                foreach ($user->user as $key => $user_index) {
                   
                    $file_path = storage_path('app/public/').$user->index_slug.$today_time.'.xlsx';
                    $data = [
                        'document' => $file_path
                    ];
                    \Mail::to($user_index->email)->send(new StockMail($data));
                }
            }
            
            
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}
