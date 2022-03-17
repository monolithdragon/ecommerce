<div>
    <div class="wrap-shop-control">

        <h1 class="shop-title">{{ $category_name }}</h1>

        <div class="wrap-right">

            <div class="sort-item orderby ">
                <select name="orderby" class="use-chosen" wire:model="sorting">
                    <option value="default" selected="selected">Default sorting</option>
                    <option value="popularity">Sort by popularity</option>
                    <option value="rating">Sort by average rating</option>
                    <option value="date">Sort by newness</option>
                    <option value="price">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                </select>
            </div>

            <div class="sort-item product-per-page">
                <select name="post-per-page" class="use-chosen" wire:model="pageSize">
                    <option value="12" selected="selected">12 per page</option>
                    <option value="16">16 per page</option>
                    <option value="18">18 per page</option>
                    <option value="21">21 per page</option>
                    <option value="24">24 per page</option>
                    <option value="30">30 per page</option>
                    <option value="32">32 per page</option>
                </select>
            </div>

            <div class="change-display-mode">
                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
            </div>

        </div>

    </div>
    <!--end wrap shop control-->
    <div class="row">

        <ul class="product-list grid-products equal-container">
            @foreach ($products as $product)
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                title="{{ $product->name }}">
                                <figure><img src="{{ asset('assets/images/products') }}/{{ $product->image }}"
                                        alt="{{ $product->name }}"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                class="product-name"><span>{{ $product->name }}</span></a>
                            <div class="wrap-price"><span class="product-price">${{ $product->price }}</span>
                            </div>
                            <a href="#" class="btn add-to-cart"
                                wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">Add
                                To Cart</a>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>

    </div>

    <div class="wrap-pagination-info">
        {{ $products->links() }}
    </div>
</div>
