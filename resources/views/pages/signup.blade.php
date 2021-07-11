@section('title', 'Sign Up')
    @extends('layouts.layout')


@section('content')
    <div class="container bg-light rounded-3 col-md-4">
        <form method="POST" action="/signup1" id="reg_form" class="row g-3 justify-content-center" onsubmit="validatePassword()">
            <div class="col-md-11">
                <label for="user_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" >
            </div>
            <div class="col-md-11">
                <label for="email" class="form-label">Bussiness Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="col-md-11">
                <label for="user_type" class="form-label">User Type</label>
                <select class="form-select" id="user_type" name="user_type" >
                    <option selected disabled value="">Choose...</option>
                    <option>Student</option>
                    <option>Bussiness</option>
                    <option>Academia</option>
                </select>
            </div>
            <div class="col-md-11">
                <label for="company" class="form-label">Company / Organization</label>
                <input type="text" class="form-control" id="company" name="company" >
            </div>
            <div class="col-md-11">
                <label for="number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="number" name="number" >
            </div>
            <div class="col-md-11">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country" >
                    <option selected disabled value="">Choose...</option>
                    <option>Student</option>
                    <option>Bussiness</option>
                    <option>Academia</option>
                </select>
            </div>
            <div class="col-md-11">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
            </div>
            <div class="col-md-11">
                <label for="c_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="c_password" name="c_password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
            </div>
            <div class="col-md-11">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" >
            </div>

            <div class="col-11">
                <p>Want to stay connected with us?</p>
                <div class="form-check" style="margin-left: 10%;">
                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter">
                    <label class="form-check-label" for="newsletter">
                        Yes, Inform me about newsletter and special offers.
                    </label>
                </div>
                <div class="form-check" style="margin-left: 10%;">
                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter_false" checked>
                    <label class="form-check-label" for="newsletter_false">
                        No, Thank you I will only receive service emails.
                    </label>
                </div>
            </div>
            <div class="col-11">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" >
                    <label class="form-check-label" for="invalidCheck2">
                        Agree to terms and conditions
                    </label>
                </div>
            </div>
            <div class="col-11">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>

    <script>
        function validatePassword() {
            var validator = $("#reg_form").validate({
                rules: {
                    password: "",
                    confirmpassword: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: " Enter Password",
                    confirmpassword: " Enter Confirm Password Same as Password"
                }
            });
            if (validator.form()) {
                alert('Sucess');
            }
        }
    </script>

@stop
