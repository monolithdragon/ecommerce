<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class ShopComponent extends Component
{
    public $shop_category;

    public function mount($category_slug)
    {
        $this->shop_category = Category::where('slug', $category_slug)->first();
    }   

    public function render()
    {
        $categories = Category::all();
        
        return view('livewire.shop-component', [
            'categories' => $categories,
            'shop_category' => $this->shop_category
        ]);
    }
}
