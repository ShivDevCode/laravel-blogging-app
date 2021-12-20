@extends('layouts.app')
@section('content')
    <section class="module">
        <div class="container">
            <div class="row ">
                <div class="col-sm-8 col-sm-offset-2 mb-sm-40 ">
                    @if (session()->has('status'))
                        <div class="alert alert-success" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><i
                                class="fa fa-cog fa-spin"></i><strong>Alert!</strong> {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="font-alt">Create Post &nbsp;&nbsp;<span><a href="{{ url('/') }}"
                                class="btn btn-d btn-sm">
                                <- Go to Home</a></span></h3>
                    <hr class="divider-w mb-10">
                    <form class="form" action="<?= url('blog') ?>" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cover_image">Post Title</label>
                            <input class="form-control input-lg" id="title" type="text" name="title" placeholder="Title" />
                            @error('title')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cover_image">Post Body</label>
                            <textarea id="editor" class="form-control input-lg" rows="7" name="body" placeholder="Textarea"
                                spellcheck="false"></textarea>
                            @error('body')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Select Category</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control input-lg" id="category_id" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('categories.create') }}" class="btn btn-d btn-xs"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cover_image">Cover Image</label>
                            <input class="form-control input-lg" id="cover_image" type="file" name="cover_image"
                                placeholder="Upload Image" />
                            @error('cover_image')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-round btn-b" type="submit">Create Post</button>
                        </div>
                        <div class="form-group"><a href="">Forgot Password?</a></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
