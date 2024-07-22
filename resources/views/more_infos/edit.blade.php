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
                    <h3 class="card-title mb-4 text-primary fw-bold text-center">Edit More Info for {{ $moreInfo->product->name }}</h3>
                    <form action="{{ route('more_infos.update', $moreInfo->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $moreInfo->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{ $moreInfo->manufacturer }}">
                        </div>
                        <div class="mb-3">
                            <label for="warranty_period" class="form-label">Warranty Period</label>
                            <input type="text" class="form-control" id="warranty_period" name="warranty_period" value="{{ $moreInfo->warranty_period }}">
                        </div>
                        <div class="mb-3">
                            <label for="additional_features" class="form-label">Additional Features</label>
                            <textarea class="form-control" id="additional_features" name="additional_features">{{ $moreInfo->additional_features }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <form action="{{ route('more_infos.destroy', $moreInfo->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this information?');">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>