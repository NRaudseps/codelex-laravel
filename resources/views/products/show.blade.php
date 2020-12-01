<h3><a href="/products">Back</a></h3>
<h2>Name: {{ $product->name }}</h2>
<a href="{{ $product->path() }}/edit">Edit Product</a>
<form action="{{ $product->path() }}" method="post">
    @csrf
    @method('delete')

    <button type="submit">Delete Product</button>
</form>
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
