<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('guestHomePage') }}">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="width: 46px;height: 46px;" />
        MyPathfinderPath
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('AdminDashboard') }}">Panel</a>
        </li>
      </ul>
      <div class="d-flex">
        <a href="{{ route('userLogout') }}">Logout</a>
      </div>
    </div>
  </div>
</nav>