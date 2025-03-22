<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
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
        Dish::Where('id', $dish->id)->delete();
        return redirect('dish')->with('message', 'Dish deleted successfully');
    }
}
