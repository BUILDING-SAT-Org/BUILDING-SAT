@extends('layouts.app')

@section('content')
    @include('includes.header')
    <div id="bg">
        <img src="/images/background.png" alt="">
    </div>
    <div>
        <main class="py-4">
            <div class="container" style="height: 900px;position: relative;">
                <div class="container-center">
                    <div class="row justify-content-center">
                        <div class="logo-container">
                            <img class="bsat-logo" src="/images/logo_hd.png">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Register') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}
                                                <i class="fa fa-question-circle" aria-hidden="true"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Name length must be a minimum of 6 characters"></i></label>

                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name" value="{{ old('name') }}" required
                                                       autocomplete="name"
                                                       autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="userType"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Type of User')}}</label>

                                            <div class="col-md-6">
                                                <select class="form-control" id="userType" name="userType" required>
                                                    <option value="underGraduate">Undergraduate</option>
                                                    <option value="student">Student</option>
                                                    <option value="postGraduate">Post graduate student</option>
                                                    <option value="academia">Academia</option>
                                                    <option value="industry">Industry practitioner</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Company
                                                   / Organization') }}
                                                <i class="fa fa-question-circle" aria-hidden="true"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Name length must be minimum of 6 characters and maximum of 50 characters"></i></label>

                                            <div class="col-md-6">
                                                <input id="company" type="text" class="form-control" name="company"
                                                       value="{{ old('company') }}" required autocomplete="company"
                                                       autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tel"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Phone Number')
                                           }}</label>

                                            <div class="col-md-6">
                                                <input id="tel" type="tel" class="form-control" name="tel"
                                                       value="{{ old('tel') }}" required autocomplete="tel" autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="country_id"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                            <div class="col-md-6">
                                                <select id="country" name="country_id" class="form-control"></select>
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
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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

                                        <div class="form-group row">
                                            <label for="news-letter"
                                                   class="col-md-4 col-form-label text-md-right"></label>

                                            <div class="col-md-8">

                                                <p>Subscribe to news letter?</p>
                                                <input type="radio" id="subscribe" name="newsletter" value=1 required>
                                                <label for="subscribe">Yes, inform me about
                                                    newsletter and special offers.</label><br>
                                                <input type="radio" id="doNotSubscribe" name="newsletter" value=0
                                                       required>
                                                <label for="doNotSubscribe">No, thank you I will receive only service
                                                    emails.</label>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
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

    <script>
        let countries;
        (function () {
            const promise1 = axios.get("/api/resources/countries");

            Promise.all([promise1]).then(function (values) {
                countries = values[0].data;

                let select = $("#country")[0];
                countries.forEach((country) => {
                    let option = document.createElement("option");
                    option.setAttribute("value", country.id);
                    option.text = country.label;
                    select.appendChild(option);
                });

                logToConsole("resources resp", {countries: countries}, LOG_TYPES.HTTP_REQUEST);

            });
        })();
    </script>
@endsection
