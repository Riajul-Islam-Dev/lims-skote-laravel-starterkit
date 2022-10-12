<div>
    <div class="input-group">
        <input type="file" {{ $attributes->merge(['class' => 'form-control']) }} required>
        <label class="input-group-text" for="{{ $attributes['name'] }}">Upload</label>
    </div>
</div>
