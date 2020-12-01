<h1>Hello</h1>
@foreach($products as $product)
    <ul>
        <li><h3>Name: {{ $product->name }}</h3></li>

    </ul>
    <div style="margin-left: 50px;">
        Size: {{ $product->size }}
        Price: {{ number_format((float) $product->price/100, 2, '.', "'"). '$' }}
        Category: {{ $product->category }}
        <br>
        <br>
        Delivery:
        @foreach($product->delivery as $delivery)
            <ul>
                <li>{{ $delivery->name }} {{ $delivery->size }}</li>
            </ul>
        @endforeach
    </div>
    <hr>
@endforeach
