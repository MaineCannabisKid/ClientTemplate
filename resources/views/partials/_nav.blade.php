<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{-- Blog --}}
                @if (Auth::guard('admin')->check())
                
                {{-- Authenticated Dropdown Menu --}}              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false">
                        Blog
                        <span class="caret"></span>
                    </a>
                    {{-- Menu Options --}}
                    <ul class="dropdown-menu" role="menu">        
                        <li><a href="{{ route('posts.index') }}">Manage Posts</a></li>
                        <li><a href="{{ route('categories.index') }}">Manage Categories</a></li>
                        <li><a href="{{ route('tags.index') }}">Manage Tags</a></li>

                        <li role="separator" class="divider"></li>
                        
                        <li><a href="{{ route('blog.index') }}">View Blog</a></li>
                    </ul>
                </li>

                @else
                
                {{-- User Dropdown Menu --}}
                <li>
                    <a href="{{ route('blog.index') }}">Blog</a>
                </li>
                
                @endif
                    
                {{-- About and Contact Links --}}
                <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about">About</a></li>
                <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact">Contact</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <!-- Authentication Links -->
                @if (Auth::guard('web')->check() || Auth::guard('admin')->check())

                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::user()->name }}
                            <span class="caret"></span>
                        </a>


                        {{-- Authenticated Dropdown Menu --}}
                        <ul class="dropdown-menu" role="menu">
                            {{-- User Links --}}
                            <li>
                                @if(Auth::guard('admin')->check())
                                    <a href="{{ route('admin.dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
                                @else
                                    <a href="{{ route('user.dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
                                @endif
                            </li>

                            {{-- Separator --}}
                            <li role="separator" class="divider"></li>

                            {{-- Logout and Form --}}
                            <li>
                                <a  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Logout
                                </a>
                                {!! Form::open(['route' => 'logout', 'id' => 'logout-form', 'style' => 'display: none;']) !!}
                                {!! Form::close() !!}
                            </li>
                        
                        </ul>{{-- End Logout Form --}}

                    </li> <!-- ./dropdown -->

                    @else

                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>

                @endif

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>