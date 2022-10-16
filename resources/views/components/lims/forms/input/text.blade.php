<div>
    <input type="text" {{ $attributes->merge(['class' => 'form-control']) }} @error('name') is-invalid @enderror>
</div>
