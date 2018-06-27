<div class="form-group">
    <label for="{{ $field }}">{{ $label ?? ucwords($field) }}</label>
    <select 
           class="form-control {{ $errors->has($field)?'is-invalid':'' }}" 
           id="{{ $field }}" name="{{ $field }}" 
           aria-describedby="{{ $field }}Help"
    >
        @forelse($options as $key=>$option)
            <option {{ $key == $value?'selected':'' }} value="{{ $key }}">{{ $option }}</option>
        @empty
            <option value="0">-</option>
        @endforelse
    </select>
    @if($errors->has($field))
        <div class="invalid-feedback">{{ $errors->first($field) }}</div>
    @else
        <small id="{{ $field }}Help" class="form-text text-muted">{{ $help ?? '' }}</small>
    @endif
</div>