@extends('layouts.app')
@section('content')
    <section class="module bg-dark-60 blog-page-header"
        style="background-image: url(https://cdn.pixabay.com/photo/2019/09/17/18/48/computer-4484282_960_720.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Blog Grid</h2>
                    <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul,
                        like these sweet mornings of spring which I enjoy with my whole heart.</div>
                </div>
            </div>
        </div>
    </section>


    <section class="module">
        <div class="container">
            <h1 class="font-alt">
                Latest Posts
            </h1>
            <hr class="divider-w mt-10 mb-20">
            <div class="row multi-columns-row post-columns">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="post">
                                <div class="post-thumbnail"><a href="./blog/{{ $post->id }}"><img
                                            style="width:360px;height:240px;"
                                            src="./storage/cover_images/{{ $post->cover_image }}"
                                            alt="Blog-post Thumbnail" /></a></div>
                                <div class="post-header font-alt">
                                    <h5 class="post-title"><a href="./blog/{{ $post->id }}">{{ $post->title }} </a>
                                    </h5>
                                    <div class="post-meta">By&nbsp;<a
                                            href="./blog/{{ $post->id }}">{{ $post->user->username }}</a>&nbsp;|
                                        {{ $post->created_at->diffForHumans() }} | {{ $post->likes->count() }}
                                        {{ Str::plural('Like', $post->likes->count()) }} &nbsp;|
                                        <a> {{ $post->category->name }}</a>
                                    </div>
                                </div>
                                <div class="post-entry">
                                    <p>{!! Str::limit(html_entity_decode($post->body), 100, '...') !!}</p>
                                </div>
                                <div class="post-more"><a class="more-link" href="./blog/{{ $post->id }}">Read more</a>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <p>There is no posts</p>
                @endif
            </div>
            <div class="pagination font-alt">
            </div>
        </div>
    </section>
    <section class="module-small bg-success">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 text-center">
                    <h4 class="font-alt mb-20">WANT TO SEE MORE?</h4><a class="btn btn-border-d" href="./blog">Lets View</a>
                </div>
            </div>
        </div>
    </section>

@endsection
