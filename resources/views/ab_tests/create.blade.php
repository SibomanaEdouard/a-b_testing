@extends('layouts.app')

@section('content')
    <h1>Create A/B Test</h1>

    <form action="{{ route('ab_tests.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>

        <div id="variants">
            <div class="variant">
                <label for="variant_name">Variant Name</label>
                <input type="text" name="variants[0][name]">

                <label for="variant_ratio">Ratio</label>
                <input type="number" name="variants[0][ratio]">
            </div>
        </div>

        <button type="button" onclick="addVariant()">Add Variant</button>

        <button type="submit">Create</button>
    </form>

    <script>
        let variantCount = 1;

        function addVariant() {
            const variantDiv = document.createElement('div');
            variantDiv.classList.add('variant');
            variantDiv.innerHTML = `
                <label for="variant_name">Variant Name</label>
                <input type="text" name="variants[${variantCount}][name]">

                <label for="variant_ratio">Ratio</label>
                <input type="number" name="variants[${variantCount}][ratio]">
            `;

            document.getElementById('variants').appendChild(variantDiv);
            variantCount++;
        }
    </script>
@endsection
