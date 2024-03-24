@php

    $name ??= '';
    $label ??= ucfirst($name);
    $value ??= '';
    $options ??= array();
    $required ??= true;
    $class ??= null;
    $onchange ??= '';

@endphp

<div @class(['form-group mb-3', $class])>

    <label for="{{ $name }}" class="form-label">
        {{ __($label) }}
        @if($required)
            <span class="text-danger fw-bold">*</span>
        @endif
    </label>

    <select id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
            name="{{ $name }}" @required($required)>
        <option value='' disabled selected> {{ __("Choisir $label") }}</option>
        @foreach($options as $k => $v)
            <option @selected($value==$v) value='{{ $v }}'>{{ $k }}</option>
        @endforeach
    </select>

    @error($name)
    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
    </span>
    @enderror

</div>
