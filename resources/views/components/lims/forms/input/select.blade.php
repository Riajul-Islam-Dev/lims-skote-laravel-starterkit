<div>
    <select {{ $attributes->merge(['class' => 'form-control select2','style'=>'width:100% !important']) }}>
        {{ $slot }}
    </select>
</div>