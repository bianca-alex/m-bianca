<nav id='header' class="navbar navbar-light bg-light navbar-static-top">
  <div class="container">
    <!-- Branding Image -->
  </div>
  <div class="container" style="max-width: 1140px;">
    <a class="navbar-brand" style="margin-left: 82px;" href="{{ url('/') }}">
      @guest
      <label style="color: #63c9c9;">首页</label>
      @else
      <label style="color: #63c9c9;">Welecome {{ Auth::user()->name }}</label>
      @endguest
    </a>
    <label>{{ $sentence }}</label>
    @guest
    @else
    <a href="{{ route('topics.create') }}" style="color: #242020;">
      <i class="fa fa-plus" aria-hidden="true"></i> 
    </a>
    @endguest 
    <form class="d-flex" role="search" action="{{ route('topics.index') }}">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    @guest
    @else
    <div class="circle">
      <img src="/images/logo.jpg" alt="love" />
    </div>
    <a href="{{ route('users.drafts') }}" alt="草稿"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
    <a href="{{ route('users.privateTopic') }}"><i class="fa fa-anchor" aria-hidden="true"></i></a>
    <a href="#" onclick="document.getElementById('logout').submit();">
      <form action="{{ route('logout') }}" method="POST" id="logout">
        {{ csrf_field() }}
        <i class="fa fa-sign-out" aria-hidden="true" style="color: #b7c3a0;"></i>
      </form>
    </a>
    @endguest
  </div>
</nav>
