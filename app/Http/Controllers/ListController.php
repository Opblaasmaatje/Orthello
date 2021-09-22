<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as Products;

class ListController extends Controller
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

    public function index()
    {
        $products = Products::with('user')->get();
        return view('shoppinglist', ["products"=>$products]);
    }
}
