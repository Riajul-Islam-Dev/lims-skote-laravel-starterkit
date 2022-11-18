<div>
    <div class="input-group" id="{{ $attributes['datepicker_id'] }}">
        <input type="text" {{ $attributes->merge(['class' => 'form-control']) }} data-date-format="dd"
            data-date-container='#{{ $attributes['datepicker_id'] }}' data-provide="datepicker" data-date-autoclose="true">
        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
</div>
