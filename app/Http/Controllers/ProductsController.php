<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator ;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sections = sections::all();
       $products = products::all();

       return view('products.products',compact('sections','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
       Validator::make($request->all(), [
            'product_name' => 'required|unique:products|max:255',
        ])->validate();
        $name = $request->product_name;
        $isExist = products::where("product_name", $name )->exists();
        if(!$isExist)
        {
            try
            {
                $product = new products();
                $product->product_name = $request->product_name;
                $product->section_id = $request->section_id;
                $product->description = $request->description;
                $product->Created_by = Auth::user()->name;
                $product->save();
                return redirect('products');
            }
            catch(Exception $e){
             return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
          }
        }else{
            return redirect('products');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
        $product =products::findorFail($request->id);
        try
          {
              $product->product_name = $request->product_name;
              $product->description = $request->description;
              $product->Created_by = Auth::user()->name;
              $product->save();
              return redirect('products');
          }
          catch(Exception $e){
           return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        products::destroy($id);
        return redirect('products');
    }
}
