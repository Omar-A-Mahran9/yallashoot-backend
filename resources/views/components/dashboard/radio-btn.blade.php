<div class="form-group row">
    <label class="col-4 col-form-label fs-5 fw-bold"><i class="bi bi-dash-lg fs-8 mx-3"></i>{{ __($title) }}</label>
    <div class="col-8 col-form-label">
        <div class="radio-inline  d-flex justify-content-start">
            @foreach ($radioBtns as $radioBtn)
                <div class="form-check form-check-custom form-check-solid mx-4">
                    <input class="form-check-input" type="radio" value="{{ $radioBtn['value'] }}"
                        name="{{ $name }}" id="{{ $radioBtn['id'] }}"
                        @if ($radioBtn['checked']) checked @endif
                        @if (isset($radioBtn['disabled'])) disabled @endif />
                    <label class="form-check-label" for="{{ $radioBtn['id'] }}">
                        {{ __($radioBtn['label']) }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
<p class="text-danger invalid-feedback" id="{{ $name }}"></p>
