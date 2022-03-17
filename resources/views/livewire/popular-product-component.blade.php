<div class="widget mercado-widget widget-product">
    <h2 class="widget-title">Popular Products</h2>
    <div class="widget-content">
        <ul class="products">
            @foreach ($popular_products as $popular_product)                                
            
            <li class="product-item">
                <div class="product product-widget-style">
                    <div class="thumbnnail">
                        <a href="{{ route('product.details', ['slug' => $popular_product->slug]) }}" title="{{ $popular_product->name }}">
                            <figure><img src="{{ asset('assets/images/products') }}/{{ $popular_product->image }}" alt="{{ $popular_product->name }}"></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="{{ route('product.details', ['slug' => $popular_product->slug]) }}" title="{{ $popular_product->name }} class="product-name"><span>{{ $popular_product->name }}</span></a>
                        <div class="wrap-price"><span class="product-price">${{ $popular_product->price }}</span></div>
                    </div>
                </div>
            </li>

            @endforeach

        </ul>
    </div>
</div><!-- brand widget-->
