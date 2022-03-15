<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination; 
    
    public function render()
    {
        $products = Product::paginate(12);
        return view('livewire.shop-component', ['products' => $products]);
    }
}
