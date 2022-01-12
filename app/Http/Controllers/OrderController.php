<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Dishes;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        $dishes = Dishes::orderBy('id','desc')->get();

        $raw_status = config('res.order_status');
        $status = array_flip($raw_status);
        $orders = Orders::where('status',[4])->get();
        return view('order_form',compact('dishes','tables','orders', 'status'));
    }

    public function submit(Request $request)
    {
        $data = array_filter($request->except('_token','table_number'));
        $orderId = rand(10001, 10000000);
        foreach ($data as $key => $value) {
            if($value > 1) {
                for ($i=0; $i < $value; $i++) { 
                    $this->saveOrder($orderId, $key, $request);
                }
            }else {
                $this->saveOrder($orderId, $key, $request);
            }
        }
        return redirect('/')->with('message', config('saveOrder.message.order_success'));
    }
    
    public function saveOrder($orderId,$dish_id,$request)
    {
        $order = new Orders();
        $order->order_id = $orderId;
        $order->dish_id = $dish_id;
        $order->table_id = $request->table_number;
        $order->status = config('res.order_status.new');
        $order->save();
    }

    public function serve(Orders $order)
    {
        $order->status = config('res.order_status.done');
        $order->save();
        return redirect('/')->with("message", config('saveOrder.message.serve'));
    }

    public function dish_search(Request $request, Table $tables) {
        if(isset($_GET['query'])) {
            $search_dish = $_GET['query'];
            $dishes = DB::table('dishes')->where('name','LIKE','%'.$search_dish.'%')->paginate(2);
            return view('searchingDish',['dishes' => $dishes], compact('tables'));
        }else {
            return redirect('/');
        }
        // $tables = new Table();
        // $searchTerm = $request->searching_dish;
        // $dishes = Dishes::query()
        // ->where('name', 'LIKE', "%{$searchTerm}%") 
        // ->get();
        // return view('/searchingDish', compact('dishes','tables'));
    }

}
