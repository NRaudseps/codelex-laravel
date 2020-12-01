<h1>Hello</h1>
<a href="/products/create">Create New Product</a>
@foreach($products as $product)
    <ul>
        <li><a href="/products/{{ $product->id }}"><h3>Name: {{ $product->name }}</h3></a></li>

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
