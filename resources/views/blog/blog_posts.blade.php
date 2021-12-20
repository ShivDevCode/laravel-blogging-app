@extends('layouts.app')
@section('content')

    <section class="module bg-dark-30"
        style="background-image: url(https://cdn.pixabay.com/photo/2015/05/31/11/25/girl-791177_960_720.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt mb-0">Blog-Posts</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row multi-columns-row post-columns" id="parent">
                        @if ($posts->count())
                            @foreach ($posts as $post)
                                <div class="col-md-6 col-sm-6 post-item <?= Str::slug($post->category->name) ?>">
                                    <div class="post">
                                        <div class="post-thumbnail"><a href="./blog/{{ $post->id }}"><img
                                                    style="width:360px;height:240px;"
                                                    src="./storage/cover_images/{{ $post->cover_image }}"
                                                    alt="Blog-post Thumbnail" /></a></div>
                                        <div class="post-header font-alt">
                                            <h2 class="post-title"><a
                                                    href="./blog/{{ $post->id }}">{{ $post->title }}</a></h2>
                                            <div class="post-meta">By&nbsp;<a
                                                    href="#">{{ $post->user->username }}</a>&nbsp;|
                                                {{ $post->created_at->diffForHumans() }} | {{ $post->likes->count() }}
                                                {{ Str::plural('Like', $post->likes->count()) }} &nbsp;|
                                                <a href="##">{{ $post->category->name }}</a>
                                            </div>
                                        </div>
                                        <div class="post-entry">
                                            <p>{!! Str::limit(html_entity_decode($post->body), 100, '...') !!}</p>
                                        </div>
                                        <div class="post-more"><a class="more-link"
                                                href="./blog/{{ $post->id }}">Read more</a></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>There is no posts</p>
                        @endif
                    </div>
                    <div class="pagination font-alt" id="pagination-container">
                        {{-- {{ $posts->links() }} --}}
                        {{-- <a href="#"><i class="fa fa-angle-left"></i></a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i class="fa fa-angle-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-sm-4 col-md-3 col-md-offset-1 sidebar">
                    <div class="widget">
                        <form role="form">
                            <div class="search-box">
                                <input id="search" class="form-control" type="text" placeholder="Search..." />
                                <i class="fa fa-search search-btn"></i>
                            </div>
                        </form>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title font-alt">Blog Categories</h5>
                        <ul class="icon-list">
                            <li><a class="active bn" id="all" style="cursor:pointer">All -
                                    {{ $posts->count() == 0 ? 0 : $posts->count() }}</a></li>
                            @foreach ($categories as $category)
                                <li><a class="bn" id="<?= Str::slug($category->name) ?>"
                                        style="cursor:pointer">{{ $category->name }} -
                                        {{ $category->posts->count() }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title font-alt">Popular Posts</h5>

                        <ul class="widget-posts">
                            @if ($postLimit->count())
                                @foreach ($postLimit as $post)
                                    @if ($post->likes->count() == $max)
                                        <li class="clearfix">
                                            <div class="widget-posts-image"><a href="./blog/{{ $post->id }}"><img
                                                        src="./storage/cover_images/{{ $post->cover_image }}"
                                                        alt="Post Thumbnail" width="80px" height="70px" /></a>
                                            </div>
                                            <div class="widget-posts-body">
                                                <div class="widget-posts-title"><a
                                                        href="./blog/{{ $post->id }}">{{ $post->title }}</a></div>
                                                <div class="widget-posts-meta">{{ $post->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <div>There is no posts</div>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    {{-- <div class="widget">
                        <h5 class="widget-title font-alt">Tag</h5>
                        <div class="tags font-serif"><a href="#" rel="tag">Blog</a><a href="#" rel="tag">Photo</a><a
                                href="#" rel="tag">Video</a><a href="#" rel="tag">Image</a><a href="#"
                                rel="tag">Minimal</a><a href="#" rel="tag">Post</a><a href="#" rel="tag">Theme</a><a
                                href="#" rel="tag">Ideas</a><a href="#" rel="tag">Tags</a><a href="#"
                                rel="tag">Bootstrap</a><a href="#" rel="tag">Popular</a><a href="#" rel="tag">English</a>
                        </div>
                    </div> --}}
                    {{-- <div class="widget">
                        <h5 class="widget-title font-alt">Text</h5>The languages only differ in their grammar, their
                        pronunciation and their most common words. Everyone realizes why a new common language would be
                        desirable: one could refuse to pay expensive translators.
                    </div> --}}
                    {{-- <div class="widget">
                        <h5 class="widget-title font-alt">Recent Comments</h5>
                        <ul class="icon-list">
                            <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                            <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                            <li>Andy on <a href="#">Eco bag Mockup</a></li>
                            <li>Jack on <a href="#">Bottle Mockup</a></li>
                            <li>Mark on <a href="#">Our trip to the Alps</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
