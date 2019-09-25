@extends('pages.home')

@neworder(['type' => $type, 'extentions' => $extentions, 'action' => ''])

    @slot('extrafields')
        <div class="form-group">
            <label for="target">{{ __('Target') }} <span class="required">*</span></label>
            <select id="target" class="form-control form-control-sm col-lg-6 col-md-6 col-sm-12 {{ $errors->has('target') ? ' is-invalid' : '' }}" name="target" value="{{ old('target') }}">
                <option value="">Select target</option>
                 @for($i = 0; $i < count($target); $i++) 
                    <option value="{{ $i }}" {{ (! is_null(old('target')) && old('target') == $i ? 'selected' : '') }}>{{ $target[$i] }}</option>   
                @endfor        
            </select>

            @if ($errors->has('target'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('target') }}
                </span>
            @endif
        </div>
    @endslot

@endneworder