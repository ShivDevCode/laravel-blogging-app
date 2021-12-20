@extends('layouts.app')
@section('content')
  <section class="module mb-50">
    <div class="container">
      @if (session()->has('status'))
      <div class="alert alert-danger col-sm-5 col-sm-offset-3" role="alert">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-coffee"></i><strong>Alert!</strong> {{ session('status') }}
      </div>
      @endif
      <div class="row ">
        <div class="col-sm-5 col-sm-offset-3 mb-sm-40 ">
          <h3 class="font-alt">Sign In</h3>
          <hr class="divider-w mb-10">
          <form class="form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
              <input class="form-control input-lg" id="email" type="text" name="email" placeholder="E-mail"/>
              @error('email')
                  <div class="text-danger mt-10">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control input-lg" id="password" type="password" name="password" placeholder="Password"/>
              @error('password')
              <div class="text-danger mt-10">
                {{ $message }}
              </div>
          @enderror
            </div>
            <div class="form-group">
              <button class="btn btn-round btn-b btn-block" type="submit">Sign In</button>
            </div>
            <div class="form-group"><span>Haven't SignUp - <a href="{{ route('register') }}" style="color: blue">Sign Up</a></span></div>
          </form>
        </div>
      </div>
    </div>
  </section> 
@endsection
