@extends('layouts.app')
@section('content')
    <section class="module mb-120">
        <div class="container">
            <div class="row">
                @if (session()->has('status'))
                    <div class="alert alert-success" role="alert">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><i
                            class="fa fa-cog fa-spin"></i><strong>Alert!</strong> {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-10">
                    <h1>{{ ucfirst(Auth::user()->username) }}'s Posts <span><a href="{{ route('dashboard') }}"
                                class="btn btn-d btn-sm">Create new one!</a></span></h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Likes</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($posts->count())
                                @foreach ($posts as $post)
                                    <tr>
                                        <th>{{ $post->id }}</th>
                                        <td><img src="../storage/cover_images/{{ $post->cover_image }}" alt=""
                                                width="50px" height="50px"></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->likes->count() }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td colspan="3">
                                            @auth
                                                @if ($post->ownedBy(auth()->user()))

                                                    <form action="" style="float: left; margin-right: 3px">
                                                        @csrf
                                                        <a href="{{ route('blog.edit', $post) }}"
                                                            class="btn btn-info btn-round btn-xs" style="color:white">Edit</a>
                                                    </form>
                                                    <form action="{{ route('blog.destroy', $post) }}" method="POST"
                                                        style="float: left; margin-right: 3px""> 
                                                        @csrf
                                                        @method('DELETE')           
                                                        <button class=" btn btn-danger btn-round btn-xs"
                                                        onclick="return confirm('Are you sure, you want to delete?');">
                                                        Delete</button>
                                                    </form>
                                                    <a href="/blog/{{ $post->id }}"
                                                        class="btn btn-success btn-round btn-xs" style="color:white">View</a>
                                                @endif
                                            @endauth

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td>
                                    <h4> <?= 'There is no posts to show !!' ?></h4>
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
