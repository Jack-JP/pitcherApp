<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function destroy($id)
    {
      Cart::instance('saveForLater')->remove($id);

      return back()->with('success','Item has been removed!');
    }

    public function addtocart($id)
    {
      $item = Cart::instance('saveForLater')->get($id);

      Cart::instance('saveForLater')->remove($id);

      $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item is already your cart');
        }

      Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');

      return redirect()->route('cart.index')->with('success', 'Item had been moved to cart');
    }
}
