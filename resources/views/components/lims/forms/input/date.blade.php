<div>
    <div class="input-group" id="datepicker">
        <input type="text" {{ $attributes->merge(['class' => 'form-control placeholder="dd-mm-yyyy"']) }}
            data-date-format="dd-mm-yyyy" data-date-container='#datepicker' data-date-end-date="0d"
            data-provide="datepicker" required>
        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
</div>
