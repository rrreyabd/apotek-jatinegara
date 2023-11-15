<div>
    @php
        if($cart_id == $cart) {
            $q = $product_quantity;
        }else{
            $q = $quantity;
        }
    @endphp
    <p class="font-semibold text-lg">Rp {{ number_format($product_price * $q , 0, ',', '.') }}</p>
</div>
