<?php

namespace App\Http\Controllers;

use App\Ratings;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userid = Auth::id();

        //Check if user already voted
        $numvotes = Ratings::where('rateable_id', $request->productid)->where('user_id', $userid)->count();
        //dd($request->star);

        if($numvotes == 0)
        {
        //new Rating
        $post = new Ratings;
        //Creata a new post using the request data
        $post->rating = $request->star;
        $post->rateable_id = $request->productid;
        $post->user_id = $userid;
        //Save it to DB
        $post->save();

        //Get new averagerating and post into products table
        $averagerating = Ratings::where('rateable_id', $request->productid)->avg('rating');
        $product = Product::find($request->productid);
        $product->averagerating = $averagerating;
        $product->save();
        }else{
          $errormessage = __('messages.rated_product');
          return redirect()->back()->with('data', $errormessage);
        }

        //And redirect
        return redirect('/shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function show(Ratings $ratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function edit(Ratings $ratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ratings $ratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ratings  $ratings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ratings $ratings)
    {
        //
    }
}
