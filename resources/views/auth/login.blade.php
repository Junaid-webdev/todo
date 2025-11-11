@extends('layouts.default')
@section('content')

<div class="col-md-10 mx-auto mt-4 col-lg-5">
    <form method="POST" action="{{route('login.post')}}" class="p-4 p-md-5 border rounded-3 bg-light">
        @csrf
          @if(session()->has('Success'))
        <div class="alert alert-success">
            {{ session()->get('Success')}}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
        @endif
        <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>
        <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
             <label for="floatingInput">Email address</label>

            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">

            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>

            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
        <hr class="my-4">
        <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
    </form>
</div>
@endsection