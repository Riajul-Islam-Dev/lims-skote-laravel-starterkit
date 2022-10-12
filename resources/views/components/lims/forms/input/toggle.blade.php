<div class="mt-2">
    <input type="checkbox" {{ $attributes->merge(['class' => 'form-control']) }} switch="bool" checked />
    <label for="{{ $attributes['name'] }}" data-on-label="Yes" data-off-label="No"></label>
</div>
