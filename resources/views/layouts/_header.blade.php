<nav class="navbar navbar-light bg-light navbar-static-top">
  <div class="container">
    <!-- Branding Image -->
  </div>
  <div class="container">
    <a class="navbar-brand" style="margin-left: 82px;" href="{{ url('/') }}">
      @guest
      @else
      <label style="color: #63c9c9;">Welecome M-bianca</label>
      @endguest
    </a>
    <label>xxxxxxxxxxxxxx</label>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>
