<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        $dishes = Dish::orderBy('id', 'Desc')->get();
        $tables = Table::all();
        $orders = Order::where('status', 4)->get();
        $res_status = config('res.order_status');
        $status = array_flip($res_status);

        return view('order_form', compact('dishes', 'tables','orders','status'));
    }

    public function submit(Request $request){

        $data = array_filter($request->except('_token', 'table_id'));
        $order_id = rand(10000,99999);

        $validated = $request->validate([
            'table_id' => 'required' 
        ]);
        
        foreach ($data as $key => $value){
            if($value > 1){
                for($i=0; $i<$value; $i++){
                    $this->saveOrder($order_id, $key, $request);
                }
            }else{
                $this->saveOrder($order_id, $key, $request);
            }
        }

        return redirect('/')->with('message','Customer\'s Order Submitted successfully');
    }

    public function saveOrder($order_id, $key, $request){
        
        $table_id = (int) $request->table_id;
        $order = new Order();
        $order->order_id = $order_id;
        $order->dish_id = $key;
        $order->table_id = $table_id;
        $order->status = config('res.order_status.new');
        $order->save();
    }
}
