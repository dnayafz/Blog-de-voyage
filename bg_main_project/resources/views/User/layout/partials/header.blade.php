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
          <a class="nav-link active" aria-current="page" href="{{ route('guestHomePage') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($categories as $category)
                    <li>
                        <a class="dropdown-item" href="{{ route('getCategoryPosts', $category['id']) }}">{{ $category['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>