<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <x-app-layout>
        <div class="container mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4 fw-bold fs-1">Simple Laravel Crud App</h1>

                    <div class="text-center mb-4">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                    </div>

                    @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 fs-2">Products</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image)
                                            <img style="width: 60px; height: 60px; object-fit: cover;" src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image" class="img-fluid">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('products.edit',$product->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger btn-sm">Delete</a>
                                            <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            @if($product->moreInfo)
                                            <a href="{{ route('more_infos.edit', $product->moreInfo->id) }}" class="btn btn-warning btn-sm">More Info</a>
                                            @else
                                            <a href="{{ route('more_infos.create', ['product' => $product->id]) }}" class="btn btn-success btn-sm">Add More Info</a>
                                            @endif
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Products Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById("delete-product-form-" + id).submit();
            }
        }
    </script>


</body>

</html>