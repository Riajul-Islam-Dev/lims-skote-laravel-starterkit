<div>
    <div class="mb-3 position-relative">
        <label {{ $attributes->merge(['class' => 'form-label']) }}
            {{ $attributes['for'] }}>{{ $attributes['label'] }}<span style="color: red">*</span></label>
        <input {{ $attributes->merge(['class' => 'form-control']) }} {{ $attributes }}>
    </div>
</div>
