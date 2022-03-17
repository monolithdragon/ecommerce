<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;

class ProductComponent extends Component
{
    use WithPagination; 

    public $sorting;
    public $pageSize;
    public $category;

    public function mount($category)
    {
        $this->sorting = 'default';
        $this->pageSize = 12;
        $this->category = $category;
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
                $sortProducts = Product::where('category_id', $this->category->id)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;

            case 'price':
                $sortProducts = Product::where('category_id', $this->category->id)->orderBy('price', 'ASC')->paginate($this->pageSize);
                break;

            case 'price-desc':
                $sortProducts = Product::where('category_id', $this->category->id)->orderBy('price', 'DESC')->paginate($this->pageSize);
                break;

            default:
                $sortProducts = Product::where('category_id', $this->category->id)->paginate($this->pageSize);
                break;
        }
        Log::info($this->sorting);
        return $sortProducts;
    }

    public function render()
    {
        $products = $this->getProducts();       

        return view('livewire.product-component', [
            'products' => $products,
            'category_name' => $this->category->name,
        ]);
    }
}
