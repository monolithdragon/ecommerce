<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination; 

    public $sorting;
    public $pageSize;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pageSize = 12;
    }
    
    public function store($id, $name, $price)
    {
        Cart::add($id, $name, 1, $price)->associate('App\Models\Product');
        session()->flash('success_messages', 'Item added to cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        switch ($this->sorting) {
            case 'date':
                $products = Product::orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            
            case 'price':
                $products = Product::orderBy('price', 'ASC')->paginate($this->pageSize);
                break;

            case 'price-desc':
                $products = Product::orderBy('price', 'DESC')->paginate($this->pageSize);
                break;
            
            default:
                $products = Product::paginate($this->pageSize);
                break;
        }
        
        return view('livewire.shop-component', ['products' => $products]);
    }
}
