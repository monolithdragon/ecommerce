<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId) 
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }

    public function reduceQuantity($rowId) 
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function delete($rowId) 
    {
        Cart::remove($rowId);
        session()->flash('success_messages', 'Item has been removed');
    }

    public function deleteAll() 
    {
        if (Cart::count() > 0)
        {
            Cart::destroy();
            session()->flash('success_messages', 'All items has been removed');
        }
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
