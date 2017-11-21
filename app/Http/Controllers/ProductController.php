<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Product;
use App\Price;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::with('price')->paginate(5);

        return view('product.show', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return  view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|unique:products',
            'description' => 'required|min:5|max:500',
            'price' => 'required',
        ], [
            'required' => 'Nie można dodać pustej treści.',
            'min' => 'Treść powinna być dłuższa niż :min znaków.',
            'unique' => 'Produkt o tej nazwie istnieje.'
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $addedProduct = DB::table('products')
            ->where('name', $request->name)
            ->first();

        Price::create([
            'product_id' => $addedProduct->id,
            'price' => $request->price
        ]);

        return redirect('/product/'.$addedProduct->id.'/edit');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $price = Product::findOrFail($id)->price()->first();

        return view('product.edit', compact('product', 'price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required|min:5|max:500',
            'price' => 'required',
        ], [
            'required' => 'Nie można dodać pustej treści.',
            'min' => 'Treść powinna być dłuższa niż :min znaków.',
        ]);

        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);

        DB::table('prices')
            ->where('product_id', $id)
            ->update([
                'price' => $request->price
            ]);

        return redirect('/product/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->delete();
        $price = Price::where('product_id', $id)->delete();

        return back();
    }
}
