<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class PopularProductComponent extends Component
{
    public function render()
    {
        $popular_products = Product::inRandomOrder()->limit(4)->get();

        return view('livewire.popular-product-component', ['popular_products' => $popular_products]);
    }
}
