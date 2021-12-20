@extends('layouts.app')
@section('content')
<section class="module mb-sm-80 mb-120">
    <div class="container">
      <div class="row ">
        <div class="col-sm-8 col-sm-offset-2 mb-sm-40 ">
          @if (session()->has('status'))
          <div class="alert alert-warning" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-cog fa-spin"></i><strong>Alert!</strong> {{ session('status') }}
          </div>
          @endif
          <h3 class="font-alt">Category &nbsp;&nbsp;<span><a href="{{ route('dashboard') }}"
            class="btn btn-d btn-sm">
            <- Go Back</a></span></h3>
          <hr class="divider-w mb-10">
          <form class="form" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="category">Add Category</label>
              <input class="form-control input-lg" id="category" type="text" name="name" placeholder="Add Category Name"/>
              @error('name')
              <div class="text-danger mt-10">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <button class="btn btn-round btn-b" type="submit">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection