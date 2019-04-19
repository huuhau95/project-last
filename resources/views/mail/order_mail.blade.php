<p><img src="https://framgia.com/wp-content/themes/frg-framgia/images/framgia-logo-black.png"></p>
<p>{{ __('Order ID: ') . $order->id }}</p>
<table border="1" width="100%">
    <tr>
        <td>{{ __('Product') }}</td>
        <td>{{ __('Size') }}</td>
        <td>{{ __('Quantity') }}</td>
        <td>{{ __('Topping') }}</td>
    </tr>
    @foreach ($order->orderDetails as $detail)
        <tr>
            <td>
                <h3>{{ $detail->product->name }}</h3>
                <h4>{{ __('message.order_detai_title.price') . ': ' . number_format($detail->product_price) . ' vnđ' }}</h4>
            </td>
            <td>{{ $detail->size->name }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>
                @foreach ($detail->toppings as $topping)
                    <p>{{ $topping->name }}</p>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>
<p>Thanks you !</p>
