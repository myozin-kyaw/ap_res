<?php

namespace App\Http\Controllers;

use App\Models\Dishes;
use App\Models\Orders;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\DishCreateRequest;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $dishes = Dishes::all();
        return view('/kitchen/dish',compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('kitchen.dish_create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishCreateRequest $request)
    {
        $dish = new Dishes();
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;

        $imageName = date('YmdHis') . " . " . request()->dish_image->getClientOriginalExtension();
        request()->dish_image->move(public_path('images'), $imageName);
        $dish->dish_image = $imageName;
        $dish->save();
        return redirect('/dish')->with('created', config('dishCRUD.alert_message.created'));
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dishes $dish)
    {
        $category = Category::all();
        return view('kitchen.dish_edit', compact('dish','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dishes $dish)
    {
        request()->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;
        if($request->dish_image) {
            $imageName = date('YmdHis') . " . " . request()->dish_image->getClientOriginalExtension();
            request()->dish_image->move(public_path('images'), $imageName);
            $dish->dish_image = $imageName;
        }
        $dish->save();
        return redirect('/dish')->with('updated', config('dishCRUD.alert_message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dishes $dish)
    {
        $dish->delete();
        return redirect('/dish')->with('deleted', config('dishCRUD.alert_message.deleted'));
    }

    public function order_list() {
        $raw_status = config('res.order_status');
        $status = array_flip($raw_status);
        $orders = Orders::whereIn('status',[1,2])->get();
        return view('kitchen.order', compact('orders', 'status'));
    }

    public function approve(Orders $order) 
    {
        $order->status = config('res.order_status.processing');
        $order->save();
        return redirect('/order')->with("message", config('saveOrder.message.approve'));
    }

    public function cancel(Orders $order) 
    {
        $order->status = config('res.order_status.cancel');
        $order->save();
        return redirect('/order')->with("cancel", config('saveOrder.message.cancel'));
    }

    public function ready(Orders $order) 
    {
        $order->status = config('res.order_status.ready');
        $order->save();
        return redirect('/order')->with("message", config('saveOrder.message.ready'));
    }

}
