<div>
    <div class="input-group" id="{{ $attributes['datepicker_id'] }}">
        <input type="text" {{ $attributes->merge(['class' => 'form-control placeholder="dd-mm-yyyy"']) }}
            data-date-format="dd-mm-yyyy" data-date-container='#{{ $attributes['datepicker_id'] }}' data-date-end-date="0d"
            data-provide="datepicker" data-date-autoclose="true">
        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
</div>
