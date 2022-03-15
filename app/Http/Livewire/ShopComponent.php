<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;

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

    private function getProducts()
    {
        switch ($this->sorting) {
            case 'date':
                $sortProducts = Product::orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            
            case 'price':
                $sortProducts = Product::orderBy('price', 'ASC')->paginate($this->pageSize);
                break;

            case 'price-desc':
                $sortProducts = Product::orderBy('price', 'DESC')->paginate($this->pageSize);
                break;
            
            default:
                $sortProducts = Product::paginate($this->pageSize);
                break;
        }

        return $sortProducts;
    }

    public function render()
    {
        $products = $this->getProducts();
        $categories = Category::all();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        
        return view('livewire.shop-component', [
            'products' => $products,
            'categories' => $categories,
            'popular_products' => $popular_products
        ]);
    }
}
