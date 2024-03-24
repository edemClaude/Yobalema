<div class="text-center form-group mt-4">
    <button type="submit" @class(["btn", $color ?? 'btn-primary', $class ?? ''])>
        <i class="bi bi-{{ $icon ?? 'save' }}"></i>
        {{ $label }}
    </button> <!-- End Submit Button -->
</div>
