  <header id="header"
      class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
      <div class="navbar-nav-wrap">
          <!-- Logo -->
          <a class="navbar-brand" href="{{ route('dashboard.home') }}" aria-label="Front">
              <img class="navbar-brand-logo" src="{{ asset('images/logoidex.png') }}" alt="Logo"
                  data-hs-theme-appearance="default">
              <img class="navbar-brand-logo" src="{{ asset('images/logoidex.png') }}" alt="Logo"
                  data-hs-theme-appearance="dark">
              <img class="navbar-brand-logo-mini" src="{{ asset('images/logoidex.png') }}" alt="Logo"
                  data-hs-theme-appearance="default">
              <img class="navbar-brand-logo-mini" src="{{ asset('images/logoidex.png') }}" alt="Logo"
                  data-hs-theme-appearance="dark">
          </a>
          <!-- End Logo -->

          <div class="navbar-nav-wrap-content-start">
              <!-- Navbar Vertical Toggle -->
              <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                  <i class="bi-arrow-bar-left navbar-toggler-short-align"
                      data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                      data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                  <i class="bi-arrow-bar-right navbar-toggler-full-align"
                      data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                      data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
              </button>


              <!-- End Search Form -->
          </div>

          <div class="navbar-nav-wrap-content-end">
              <!-- Navbar -->
              <ul class="navbar-nav">





                  <li class="nav-item">
                      <!-- Account -->
                      <div class="dropdown">
                          @if (Auth::user() !== null)
                              <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                                  data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                                  data-bs-dropdown-animation>
                                  <div class="avatar avatar-sm avatar-circle">
                                      <img class="avatar-img"
                                          src="{{ asset(Auth::user()->image ? Auth::user()->image : asset('images/no-image1.jpg')) }}"
                                          alt="Image Description">
                                      <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                  </div>
                              </a>

                              <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                                  aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                                  <div class="dropdown-item-text">
                                      <div class="d-flex align-items-center">
                                          <div class="avatar avatar-sm avatar-circle">
                                              <img class="avatar-img"
                                                  src="{{ asset(Auth::user()->image ? Auth::user()->image : asset('images/no-image1.jpg')) }}"
                                                  alt="Image Description">
                                          </div>

                                          <div class="flex-grow-1 ms-3">
                                              <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                              <p class="card-text text-body">{{ Auth::user()->email }}</p>
                                          </div>
                                      </div>

                                  </div>

                                  <div class="dropdown-divider"></div>


                                  <a class="dropdown-item" href="{{ route('profile.page') }}">Profile &amp; account</a>








                                  <div class="dropdown-divider"></div>

                                  <form id="logoutForm" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                      @csrf
                                  </form>

                                  <!-- Sign Out Link -->
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="preventMultipleLogout(event);">
                                      Sign out
                                  </a>

                              </div>
                          @endif

                      </div>

                      <!-- End Account -->
                  </li>
              </ul>
              <!-- End Navbar -->
          </div>
      </div>
  </header>


  <script>
      function preventMultipleLogout(event) {
          event.preventDefault();
          const logoutLink = event.target;
          logoutLink.style.pointerEvents = 'none';
          logoutLink.innerText = 'Signing out...';
          document.getElementById('logoutForm').submit();
      }
  </script>
