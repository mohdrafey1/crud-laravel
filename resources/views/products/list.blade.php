<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>

<body class="bg-light">
    <x-app-layout>
        <div class="container mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4 fw-bold fs-1">Simple Laravel Crud App</h1>

                    <div class="text-center mb-4">
                        @can('create products')
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                        @endcan
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
                            <table class="table table-striped table-bordered" id="product-table">
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return data ? `<img src="{{ url('uploads/products') }}/${data}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">` : 'No Image';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'sku',
                        name: 'sku'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, full, meta) {
                            return moment(data).format('DD-MM-YY');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $(document).on('click', '.delete-button', function(event) {
                event.preventDefault();
                const productId = $(this).data('product-id');
                if (confirm("Are you sure you want to delete this product?")) {
                    $('#delete-product-form-' + productId).submit();
                }
            });
        });
    </script>
</body>

</html>