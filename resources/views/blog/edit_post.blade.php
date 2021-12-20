@extends('layouts.app')
@section('content')
    <section class="module">
        <div class="container">
            <div class="row ">
                <div class="col-sm-8 col-sm-offset-2 mb-sm-40 ">
                    @if (session()->has('status'))
                        <div class="alert alert-success" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><i
                                class="fa fa-cog fa-spin"></i><strong>Alert!</strong> {{ session('status') }}&nbsp;&nbsp;<a
                                href="/blog/{{ $post->id }}" style="color: blue">View -
                                <?= url("/blog/{{ $post->id }}") ?></a>
                        </div>
                    @endif
                    <h3 class="font-alt">Update Post</h3>
                    <hr class="divider-w mb-10">
                    <form class="form" action="{{ route('blog.update', $post->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title ">Post Title</label>
                            <input class="form-control input-lg" id="title" type="text" name="title"
                                value="{{ $post->title }}" />
                            @error('title')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Post Body</label>
                            <textarea id="editor" class="form-control input-lg" rows="7" name="body"
                                spellcheck="false">{{ $post->body }}</textarea>
                            @error('body')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Select Category</label>
                            <select class="form-control input-lg" id="category_id" name="category_id">
                                <option type="hidden" value="{{ $post->category->id }}">{{ $post->category->name }}
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('title')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cover_image">Cover Image</label>
                            <input class="form-control input-lg" id="cover_image" type="file" name="cover_image" />
                            <img id="output" style="float: right" width="50px" height="50px"
                                src="/storage/cover_images/{{ $post->cover_image }}" alt="" srcset="">
                            @error('cover_image')
                                <div class="text-danger mt-10">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-round btn-b" type="submit">Update Post</button>
                        </div>
                        <div class="form-group"><a href="">Forgot Password?</a></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
