@extends('pages.home')

@neworder(['type' => $type, 'extentions' => $extentions, 'action' => ''])

    @slot('extrafields')
        <div class="form-group">
            <label for="field">{{ __('Field') }} <span class="required">*</span></label>
            <select  id="field" class="form-control form-control-sm col-lg-6 col-md-6 col-sm-12 {{ $errors->has('field') ? ' is-invalid' : '' }}" value="{{ old('field') }}" name="field">
                <option value="">Select field</option>
                @for($i = 0; $i < count($fields); $i++) 
                    <option value="{{ $i }}" {{ (! is_null(old('field')) && old('field') == $i ? 'selected' : '') }}>{{ $fields[$i] }}</option>   
                @endfor
            </select>

            @if ($errors->has('field'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('field') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="type">{{ __('Type') }} <span class="required">*</span></label>
            <select id="type" class="form-control form-control-sm col-lg-5 col-md-5 col-sm-12 {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}">
                <option value="">Select type</option>
                @for($i = 0; $i < count($paper_type); $i++) 
                    <option value="{{ $i }}" {{ (! is_null(old('type')) && old('type') == $i ? 'selected' : '') }}>{{ $paper_type[$i] }}</option>   
                @endfor
            </select>

            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('type') }}
                </span>
            @endif
        </div>
    @endslot
@endneworder