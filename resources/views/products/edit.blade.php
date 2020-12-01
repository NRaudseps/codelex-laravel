<h3><a href="{{ $product->path() }}">Back</a></h3>
<form action="{{ $product->path() }}" method="post">
    @csrf
    @method('put')

    <label for="name">Enter Name:</label>
    <input type="text" name="name" placeholder="Name">
    <br>

    <label for="size">Enter Size:</label>
    <input type="text" name="size" placeholder="Size">
    <br>

    <label for="price">Enter Price:</label>
    <input type="number" name="price" placeholder="Price">
    <br>

    <label for="category">Enter Category:</label>
    <input type="text" name="category" placeholder="Category">
    <br>

    <button type="submit">Submit</button>
</form>
