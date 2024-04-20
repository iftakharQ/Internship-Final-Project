  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-base navbar-light" id="topNav">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/explore') }}" class="nav-link">Explore</a>
      </li>

      @if (Route::has('login'))
      @auth
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('show_user_history') }}" class="nav-link">History</a>
      </li>
      @endauth
      @endif

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form  class="form-inline">
            
            <div class="input-group input-group-sm">
              <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>


      @if (Route::has('login'))
      @auth
            <x-app-layout>
            </x-app-layout>  
      @else
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('login') }}">Login</a>
          @if (Route::has('register'))
          <a class="dropdown-item" href="{{ route('register') }}">Register</a>
          @endif
        </div>
        <!-- <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-user"></i>
        </a> -->
      </li>
      @endauth
      @endif


      <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
        </li> -->

      <!-- Messages Dropdown Menu -->
      <!-- @message.html -->

      <!-- Notifications Dropdown Menu -->
      <!-- @notificatio.html -->

      <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
        </li> -->

      <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->

    </ul>
  </nav>
  <!-- /.navbar -->