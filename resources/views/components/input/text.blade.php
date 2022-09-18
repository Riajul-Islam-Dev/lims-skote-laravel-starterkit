<div class="mb-3 position-relative">
    <label for="role_name" class="form-label">{{$attributes['label']}}<span style="color: red">*</span></label>
    <input type="text" {{ $attributes->merge(['class' => 'form-control']) }} {{$attributes}} placeholder="Role Name" required>
    <div class="valid-tooltip">
        Looks good!
    </div>
    <div class="invalid-tooltip">
        Please enter new Role name!
    </div>
</div>