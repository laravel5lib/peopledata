<div class="form-group">
    <label for="{{ $field }}">{{ $label ?? ucwords($field) }}</label>
    <textarea name="{{ $field }}" 
              id="{{ $field }}" 
              rows="3" 
              placeholder="{{ $placeholder ?? '' }}" 
              class="form-control {{ $errors->has($field)?'is-invalid':'' }}" 
              aria-describedby="{{ $field }}Help">{{ $value ?? '' }}</textarea>
    @if($errors->has($field))
        <div class="invalid-feedback">{{ $errors->first($field) }}</div>
    @else
        <small id="{{ $field }}Help" class="form-text text-muted">{{ $help ?? '' }}</small>
    @endif
</div>