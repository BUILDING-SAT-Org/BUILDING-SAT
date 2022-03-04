@extends('layouts.app')

@section('content')
    @include('includes.header')
    <div id="bg">
        <img src="/images/background.png" alt="">
    </div>
    <div>
        <main class="py-4">
            <div class="container" style="height: 600px;position: relative;">
                <div class="container-center">
                    <div class="row justify-content-center">
                        <div class="logo-container">
                            <img class="bsat-logo" src="/images/logo_hd.png">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">{{ __('Reset Password') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $request->token }}">

                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ $request->email }}" required
                                                       autocomplete="email" autofocus
                                                       readonly>

                                                @error('email')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                                <i class="fa fa-question-circle" aria-hidden="true"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Password length must be a minimum of 8 characters and should contain
                                           at least 1 capital letter, 1 small letter and 1 number"></i></label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password"
                                                       required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required
                                                       autocomplete="new-password">
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
            </div>
        </main>
    </div>
@endsection
