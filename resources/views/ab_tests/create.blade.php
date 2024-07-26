@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create A/B Test</h1>

    <form action="{{ route('ab_tests.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div id="variants">
            <div class="variant mb-3">
                <label for="variant_name" class="form-label">Variant Name</label>
                <input type="text" name="variants[0][name]" class="form-control" required>

                <label for="variant_ratio" class="form-label mt-2">Ratio</label>
                <input type="number" name="variants[0][ratio]" class="form-control" required>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addVariant()">Add Variant</button>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <script>
        let variantCount = 1;

        function addVariant() {
            const variantDiv = document.createElement('div');
            variantDiv.classList.add('variant', 'mb-3');
            variantDiv.innerHTML = `
                <label class="form-label">Variant Name</label>
                <input type="text" name="variants[${variantCount}][name]" class="form-control" required>

                <label class="form-label mt-2">Ratio</label>
                <input type="number" name="variants[${variantCount}][ratio]" class="form-control" required>
            `;

            document.getElementById('variants').appendChild(variantDiv);
            variantCount++;
        }
    </script>
</div>
@endsection
