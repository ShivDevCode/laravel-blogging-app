@extends('layouts.app')
@section('content')       
  <section class="module">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h4 class="font-alt">Sign Up</h4>
          <hr class="divider-w mb-10">
          <form class="form" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
              <input class="form-control input-lg" id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}"/>
              @error('name')
              <div class="text-danger mt-10" >
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control input-lg" id="username" type="text" name="username" placeholder="Username" value="{{ old('username') }}"/>
              @error('username')
              <div class="text-danger mt-10" >
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control input-lg" id="email" type="text" name="email" placeholder="Email" value="{{ old('email') }}"/>
              @error('email')
              <div class="text-danger mt-10" >
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control input-lg" id="password" type="password" name="password" placeholder="Password"/>
              @error('password')
              <div class="text-danger mt-10" >
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control input-lg" id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter Password"/>
              @error('password_confirmation')
              <div class="text-danger mt-10" >
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <button class="btn btn-block btn-round btn-b btn-lg" type="submit">Sign Up</button>
            </div>
            <div class="form-group"><span>Already a member - <a href="{{ route('login') }}" style="color: blue">Sign In</a></span></div>
          </form>
        </div>
      </div>
    </div>
  </section> 
@endsection
