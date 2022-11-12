<div {{ $attributes->merge(['class' => 'input-daterange input-group']) }} id="{{ $attributes['id'] }}"
    data-date-format="dd" data-date-autoclose="true" data-provide="datepicker"
    data-date-container='#{{ $attributes['id'] }}'>
    <input type="text" class="form-control" id="{{ $attributes['id_start'] }}" name="{{ $attributes['name_start'] }}"
        placeholder="Start Date" />
    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    <input type="text" class="form-control" id="{{ $attributes['id_end'] }}" name="{{ $attributes['name_end'] }}"
        placeholder="End Date" />
    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
</div>
