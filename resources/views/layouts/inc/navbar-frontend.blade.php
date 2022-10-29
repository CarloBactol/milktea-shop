<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Milkteashop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : ''}}" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">

            @if (Auth::check())
            {{ Auth::user()->name }}
            @else
            Sign Up
            @endif
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @if (Route::has('login'))
            <li class="nav-item">
              @auth
              <a class="dropdown-item" href="{{ url('/my-order') }}">My Orders</a>

              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
              @else
              <a href="{{ route('login') }}" class="dropdown-item">Log in</a>

              @if (Route::has('register'))
              <a href="{{ route('register') }}" class="dropdown-item ">Register</a>
              @endif
            </li>
            @endauth
            @endif
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('shop') ? 'active' : ''}}" href="{{ url('/shop') }}">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('cart') ? 'active' : ''}}" href="{{ url('/cart') }}">Cart <span
              class="badge bg-success cart-count">0</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>