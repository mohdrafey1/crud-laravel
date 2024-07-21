<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <div class="container mt-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <h3 class="card-title mb-4 text-primary fw-bold text-center">Edit Product</h3>
                    <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input value="{{ old('name',$product->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter product name">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sku" class="form-label fw-bold">SKU</label>
                            <input value="{{ old('sku',$product->sku) }}" type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" placeholder="Enter SKU">

                            @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">Price</label>
                            <input value="{{ old('price',$product->price) }}" type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter price">

                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description',$product->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if ($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image" class="mt-5 mb-5 rounded mx-auto d-block w-50 h-50">
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>