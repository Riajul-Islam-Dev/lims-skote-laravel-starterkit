<div>
    <input type="number" {{ $attributes->merge(['class' => 'form-control']) }} @error('name') is-invalid @enderror>
</div>