@extends('pages.home')

@neworder(['type' => $type, 'extentions' => $extentions, 'action' => ''])

    @slot('extrafields')
        <div class="form-group">
            <label for="area">{{ __('Research area') }} <span class="required">*</span></label>
            <select id="area" class="form-control form-control-sm col-lg-6 col-md-6 col-sm-12 {{ $errors->has('area') ? ' is-invalid' : '' }}" name="area">
                <option value="" >Select research area</option>
                 @for($i = 0; $i < count($area); $i++) 
                    <option value="{{ $i }}" {{ (! is_null(old('area')) && old('area') == $i ? 'selected' : '') }}>{{ $area[$i] }}</option>   
                @endfor        
            </select>

            @if ($errors->has('area'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('area') }}
                </span>
            @endif
        </div>
    @endslot

@endneworder