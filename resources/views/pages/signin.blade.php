@section('title', 'Sign In')
    @extends('layouts.layout')


@section('content')
    <div class="container bg-light rounded-3 col-md-4">
        <form method="POST" action="/signIn1" id="reg_form" class="row g-3 justify-content-center">
            <div class="col-md-11">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="col-md-11">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <div class="col-11">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
@stop
