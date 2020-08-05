<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp\Client;

class StockExport implements FromCollection, WithHeadings,ShouldQueue
{
    use Exportable;

   public function collection($index_type=null)
    {
       
        if($index_type == 1){
            $stock_index_api = 'NSEI';
        }else{
            $stock_index_api = 'NSEBANK';
        }
       
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://financialmodelingprep.com/api/v3/historical-chart/1hour/%5E'.$stock_index_api.'?apikey=1c0d4006bd428cf957cf860021dd95c4']);
        $response = $client->request('GET', '');
        $json_response = $response->getBody()->getContents(); 
        $collection = json_decode($json_response,true);
        
        return collect($collection);
    }

    public function headings(): array
    {
        return [
            'DATE',
            'OPEN PRICE',
            'LOW PRICE',
            'HIGH PRICE',
            'CLOSE',
            'VOLUME'
        ];
    }

}

