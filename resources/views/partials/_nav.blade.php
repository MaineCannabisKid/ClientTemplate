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
            <li class="{{ Request::is('home') || Request::is('admin') ? "active" : "" }}">
              
              @if(Auth::guard('web')->check())
                <a href="/home">Home <span class="sr-only">(current)</span></a>
              @else
                <a href="/admin">Home <span class="sr-only">(current)</span></a>
              @endif

            </li>
            <li class="{{ Request::is('blog') ? "active" : "" }}"><a href="/blog">Blog</a></li>
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
                  {{-- Admin Links --}}
                  @if (Auth::guard('admin')->check())
                    <li><a href="{{ route('posts.index') }}">Manage Blog Posts</a></li>
                    <li role="separator" class="divider"></li>
                  @endif
                  
                  {{-- User Links --}}
                  @if (Auth::guard('web')->check() || Auth::guard('admin')->check())
                    <li><a href="#">User Test Link</a></li>
                    <li role="separator" class="divider"></li>
                  @endif

                  {{-- Logout and Form --}}
                  <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                    </a>
                    {!! Form::open(['route' => 'logout', 'id' => 'logout-form', 'style' => 'display: none;']) !!}
                    {!! Form::close() !!}
                  </li>
                  {{-- End Logout Form --}}
                </ul>
              </li>
            @else
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
            @endif
          </ul>


        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>