<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = 'default';
        $this->pageSize = 12;
        $this->$category_slug = $category_slug;

    }

    public function store($id, $name, $price)
    {
        Cart::add($id, $name, 1, $price)->associate('App\Models\Product');
        session()->flash('success_messages', 'Item added to cart');
        return redirect()->route('product.cart');
    }

    private function getProducts($id)
    {
        switch ($this->sorting) {
            case 'date':
                $sortProducts = Product::where('category_id', $id)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;

            case 'price':
                $sortProducts = Product::where('category_id', $id)->orderBy('price', 'ASC')->paginate($this->pageSize);
                break;

            case 'price-desc':
                $sortProducts = Product::where('category_id', $id)->orderBy('price', 'DESC')->paginate($this->pageSize);
                break;

            default:
                $sortProducts = Product::where('category_id', $id)->paginate($this->pageSize);
                break;
        }

        return $sortProducts;
    }

    public function render()
    {
        $category = Category::where('slug', $this->category_slug)->first();
        $products = $this->getProducts($category->id);

        $categories = Category::all();

        return view('livewire.category-component', [
            'products' => $products,
            'categories' => $categories,
            'category_name' => $category->name
        ]);
    }
}
