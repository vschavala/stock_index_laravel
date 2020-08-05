<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockIndex;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stock_indexs = StockIndex::with('user')->get();
        
        return view('home',compact('stock_indexs'));
    }
    /**
     * Storing indexes to pivot table
     * 
     * @return void
     */
    public function stockIndexStore(Request $request){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $stock_indexs = StockIndex::all();
        $stock_index_id = $request->all();
        if($request->has('stock_index')){
            $index_id = $stock_index_id['stock_index'];
        
        foreach ($stock_indexs as $key => $value) {
           $user->stockIndex()->detach([$value->id]);
        }
            $user->stockIndex()->attach($index_id);
             
        }else{
            foreach ($stock_indexs as $key => $value) {
                $user->stockIndex()->detach([$value->id]);
            }
        }
        
        return redirect()->back();

    }
}
