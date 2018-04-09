<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$products = Product::where('featured', true)->take(8)->inRandomOrder()->get();
      //$mightAlsoLike = Product::mightAlsoLike()->get();
      $products = Product::inRandomOrder()->take(8)->get();
      $categories = Category::all();
      //return view('landing-page', compact('products','mightAlsoLike'));
      return view('landing-page', compact('products','categories'));
    }


}
