<div>
    <div class="input-group" id="{{ $attributes['datepicker_id'] }}">
        <input type="text" {{ $attributes->merge(['class' => 'form-control']) }} data-date-format="yyyy"
            data-date-container='#{{ $attributes['datepicker_id'] }}' data-provide="datepicker" data-date-autoclose="true"
            data-date-min-view-mode="2">
        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
</div>