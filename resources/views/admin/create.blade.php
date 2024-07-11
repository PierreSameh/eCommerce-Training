<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>

    <div class="form-group">
        <label for="description">Price</label>
        <input type="text" class="form-control" id="price" name="price">
    </div>

    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
