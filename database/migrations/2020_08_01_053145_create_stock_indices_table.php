<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\StockIndex;

class CreateStockIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_indices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('index');
            $table->string('index_slug')->nullable();
            $table->timestamps();
        });
    /**
     * php artisan migrate
     * insert values into stock_indices table
     * Instead of using seeder, written directly into migrations
     */
        $indexes = [['index'=>'NIFTY 50','index_slug' => 'Nifty_50'],['index'=>'BANK NIFTY','index_slug' =>'Bank_nifty']];
        foreach ($indexes as $key => $index) {
            StockIndex::create(['index' => $index['index'],'index_slug' => $index['index_slug']]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_indices');
    }
}
