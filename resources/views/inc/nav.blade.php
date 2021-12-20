<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span
                    class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand"
                href="{{ url('/') }}">Creative</a>
        </div>
        <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown active"><a href="{{ url('/') }}">Home</a>
                </li>
                <li class="dropdown"><a href="{{ url('blog') }}">Posts</a>
                </li>
                <li class="dropdown"><a href="{{ route('dashboard') }}">Create Post</a>
                </li>

                @guest
                    <li class="dropdown"><a href="{{ route('login') }}">Sign In</a>
                    </li>
                    <li class="dropdown"><a href="{{ route('register') }}">Sign Up</a>
                    </li>
                @endguest

                @auth
                    <li class="dropdown"><a class="dropdown-toggle" href="#"
                            data-toggle="dropdown">Howday!&nbsp;{{ Auth::user()->username }}</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown"><a href="{{ route('posts.list') }}">All Posts</a>
                            </li>
                            <li class="dropdown">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="btn btn-b btn-block" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
