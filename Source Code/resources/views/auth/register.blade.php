@extends('layouts.main')

@section('content')


    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
            
        <div class="col-md-12 col-lg-8 mb-5">
        <br>
        <h1>Seeker Registration</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" value="seeker" name="user_type">
                    <div class="form-group row">
                       <div class="col-md-12">Name</div>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-12">Email</div>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">Date Of Birthday</div>
                            <div class="col-md-12">
                                <input id="datepicker" type="text" class="form-control" name="dob" required>
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-12">Password</div>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">Confirm Password</div>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12"> Gender</div>
                            <div class="col-md-12">
                                <input type="radio" name="gender" value="male" required="">&nbsp;Male
                                <input type="radio" name="gender" value="female" required="">&nbsp;Female
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         

                        <div class="form-group row ">
                            <div class="col-md-12">
                                <input type="submit" value="Register as Seeker" class="btn btn-primary" py-2 px-5>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
