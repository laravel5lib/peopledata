<div class="form-group">
    <label for="{{ $field }}">{{ $label ?? ucwords($field) }}</label>
    @if(isset($prepend))
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">{{ $prepend }}</div>
            </div>
            <input type="text"
                   class="form-control {{ $errors->has($field)?'is-invalid':'' }}"
                   id="{{ $field }}" name="{{ $field }}"
                   aria-describedby="{{ $field }}Help"
                   placeholder="{{ $placeholder ?? '' }}"
                   value="{{ $value ?? '' }}">
        </div>
    @else
        <input type="text"
               class="form-control {{ $errors->has($field)?'is-invalid':'' }}"
               id="{{ $field }}" name="{{ $field }}"
               aria-describedby="{{ $field }}Help"
               placeholder="{{ $placeholder ?? '' }}"
               value="{{ $value ?? '' }}">
    @endif
    @if($errors->has($field))
        <div class="invalid-feedback">{{ $errors->first($field) }}</div>
    @else
        <small id="{{ $field }}Help" class="form-text text-muted">{{ $help ?? '' }}</small>
    @endif
</div>