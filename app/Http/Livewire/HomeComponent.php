<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class HomeComponent extends Component
{
    public function render()
    {
        $onsale_products = Product::where('on_sale', true)->get();
        $latest_products = Product::where('created_at', '>=', now()->subDays(5))->limit(10)->get();

        return view('livewire.home-component', [
            'onsale_products' => $onsale_products,
            'latest_products' => $latest_products
        ]);
    }
}
