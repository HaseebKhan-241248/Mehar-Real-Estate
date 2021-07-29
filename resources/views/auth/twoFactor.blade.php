<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@if(session()->has('message'))
    <p class="alert alert-info">
        {{ session()->get('message') }}
    </p>
@endif
<div class="container" style="margin-top:50px; ">
<form method="POST" action="{{ route('verify.store') }}">
    {{ csrf_field() }}
    <h1>Two Factor Verification</h1>
    <p class="text-muted">
        You have received an email which contains two factor login code.
        If you haven't received it, press <a href="{{ route('verify.resend') }}">here</a>.
    </p>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-lock"></i>
            </span>
        </div>
        <input name="two_factor_code" type="text"
            class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}"
            required autofocus placeholder="Two Factor Code">
        @if($errors->has('two_factor_code'))
            <div class="invalid-feedback">
                {{ $errors->first('two_factor_code') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-6">
            <button type="submit" class="btn btn-primary px-4">
                Verify
            </button>
        </div>
    </div>
</form>
</div>
