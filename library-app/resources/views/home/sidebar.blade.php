  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-base elevation-4">
      <!-- Brand Logo -->
      <a href="{{ URL::to('/') }}" class="brand-link">
          <img src="{{ asset('images/Spellbound_Pages_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Spellbound Pages</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          @if (Route::has('login'))
          @auth

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" style="min-width: 2.1rem;"> -->
                  <i class="fa-solid fa-circle-user img-circle elevation-2" style="font-size: 2.1rem;"></i>
              </div>
              <div class="info">
                  <a href="#" class="d-block user-name">{{ Auth::user()->name }}</a>
              </div>
          </div>

          @endauth
          @endif

          <!-- SidebarSearch Form -->
          <form>
                
              <div class="form-inline mt-4">
                  <div class="input-group">
                      <input name="search" class="form-control form-control-sidebar bg-white" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                          <button class="btn btn-sidebar" type="submit">
                              <i class="fas fa-search fa-fw"></i>
                          </button>
                      </div>
                  </div>
              </div>
          </form>

          <!-- Sidebar Menu -->
          <nav class="mt-2" id="sidebarMenu">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  <li class="nav-item">
                      <a href="{{ URL::to('/') }}" class="nav-link">
                          <i class="nav-icon fa-solid fa-house-chimney"></i>
                          <p>
                              Home

                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ URL::to('/explore') }}" class="nav-link">
                          <i class="nav-icon fa-regular fa-compass"></i>
                          <p>
                              Explore

                          </p>
                      </a>
                  </li>

                  @if (Route::has('login'))
                  @auth

                  <li class="nav-item">
                      <a href="{{ URL::to('/show_user_history') }}" class="nav-link">
                          <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                          <p>
                              History

                          </p>
                      </a>
                  </li>

                  @endauth
                  @endif

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>