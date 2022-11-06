<div>
    <select {{ $attributes->merge(['class' => 'form-control select2']) }}>
        {{ $slot }}
    </select>
</div>
