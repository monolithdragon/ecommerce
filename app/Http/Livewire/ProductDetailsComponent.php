<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductDetailsComponent extends Component
{
    public $slug;
    public $qty;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function store($id, $name, $price)
    {
        Cart::add($id, $name, $this->qty, $price)->associate('App\Models\Product');
        session()->flash('success_messages', 'Item added to cart');
        return redirect()->route('product.cart');
    }

    public function increaseQuantity() 
    {
        $this->qty++;
        $product = Product::where('slug', $this->slug)->first();
        if ($this->qty > $product->quantity)
            $this->qty = $product->quantity;

        
    }

    public function reduceQuantity() 
    {
        $this->qty--;
        if ($this->qty < 1)
            $this->qty = 1;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();

        return view('livewire.product-details-component', [
            'product' => $product,
            'popular_products' => $popular_products,
            'related_products' => $related_products
        ]);
    }
}
