@php
    $value ??= true;
    $checked = $value ? 'checked' : '';
    $name ??= '';
    $label ??= ucfirst($name);
    $required ??= false;
@endphp

<div class="form-check">
    <input class="form-check-input @error($name) is-invalid @enderror" type="checkbox"
           id="{{ $name }}" {{ $checked }} name="{{ $name }}" @required($required)
    >

    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>

    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
