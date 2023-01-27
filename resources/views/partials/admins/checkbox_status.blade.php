@foreach($enum::values() as $key => $value)
    <label class="form-check form-check-inline">
        <input class="form-check-input" name="status[]" type="checkbox"
               value="{{ $key }}"
               @if ((is_array(request()->query('status'))
                    && in_array($key, request()->query('status'))
               || !request()->has('status'))
               )
                   checked
            @endif
        />
        <span
            class="form-check-label">{{ $enum::getLabel($value) }}</span>
    </label>
@endforeach
