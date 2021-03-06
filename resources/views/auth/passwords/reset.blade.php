@extends('admin.layouts.app')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('password_status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('password_status') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! Session('error') !!}</strong>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-5">
                    <div class="user-display">
                        <div class="user-display-bg"><img src="{{ asset('assets/img/user-profile-display.png') }}" alt="Profile Background"></div>
                        <div class="user-display-bottom">
                            <div class="user-display-avatar"><img src="{{ asset('assets/img/avatar-150.png') }}" alt="Avatar"></div>
                            <div class="user-display-info">
                                <div class="name">{{ $user->name }}</div>
                                <div class="nick"><span class="mdi mdi-account"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="widget widget-fullwidth widget-small">
                        <div class="widget-head xs-pb-30">
                            <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                            <div class="title">Profile</div>
                        </div>
                        <div class="widget-chart-container">
                            <div id="bar-chart1" style="height: 180px; padding: 0px; position: relative;">
                                <canvas class="flot-base" width="611" height="180" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 611.078px; height: 180px;"></canvas><canvas class="flot-overlay" width="611" height="180" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 611.078px; height: 180px;"></canvas>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="POST" action="{{ route('password.update') }}">
                                                @csrf

                                                <input type="hidden" name="token" value="">

                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email" autofocus>
                                                        </div>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        </div>

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                    <div class="col-md-6">
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Reset Password') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection

