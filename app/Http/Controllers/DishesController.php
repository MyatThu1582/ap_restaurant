<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\Order;
use App\Models\Table;
use App\Http\Requests\StoreDishRequest;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::all();
        return view("dish.view", compact("dishes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("dish.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
    // dd($request->all(), $request->file('dish_img'));
        $dish = new Dish();
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;

        $imageName = time().'.'.request()->dish_img->getClientOriginalExtension();
        request()->dish_img->move(public_path('images'), $imageName);
        $dish->image = $imageName;
        $dish->save();

        return redirect('dish')->with('message', 'Dish added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view("dish.edit", compact("categories","dish"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
        ]);
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;
        if($request->dish_img){
            $imageName = time().'.'.request()->dish_img->getClientOriginalExtension();
            request()->dish_img->move(public_path('images'), $imageName);
            $dish->image = $imageName;
        }
        $dish->save();
        return redirect('dish')->with('message', 'Dish updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect('dish')->with('message', 'Dish deleted successfully');
    }

    public function order(){
        
        $res_status = config('res.order_status');
        $status = array_flip($res_status);

        $orders = Order::whereIn('status', [1,2])->get();
        return view('kitchen.order', compact('orders', 'status'));
    }

    public function approve(Order $order){
        $order->status = config('res.order_status.processing');
        $order->save();
        return redirect('order')->with('message', 'Order approved successfully');
    }
    public function cancel(Order $order){
        $order->status = config('res.order_status.cancel');
        $order->save();
        return redirect('order')->with('message', 'Order Rejected');
    }
    public function ready(Order $order){
        $order->status = config('res.order_status.ready');
        $order->save();
        return redirect('order')->with('message', 'Order is ready to serve');
    }

    public function done(Order $order){
        $order->status = config('res.order_status.done');
        $order->save();
        return redirect('/')->with('message', 'Order served Successfully');
    }

    public function search(Request $request){ 
    
        $validated = $request->validate([
            'search' => 'required|string|max:255'
        ]);
        $searchTerm = $validated['search']; // Extract validated input
        $tables = Table::all();
        $orders = Order::where('status', 4)->get();
        
        $dishes = Dish::where('name', 'like', '%' . $searchTerm . '%')->get(); // Use get() instead of all()
        return view('order_form', compact('dishes', 'tables', 'orders'));
    }
    
}
