<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
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

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">


                    <span class="dropdown-header mt-4">Pages</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <!-- Collapse -->
                    <div class="navbar-nav nav-compact">

                    </div>
                    <div id="navbarVerticalMenuPagesMenu">

                        <div class="nav-item">
                            <a class="nav-link " href="{{ route('dashboard.home') }}" data-placement="left">
                                <i class="bi-house-door nav-icon"></i>
                                <span class="nav-link-title">Home</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link " href="{{ route('blog.index') }}" data-placement="left">
                                <i class="bi-eye nav-icon"></i>
                                <span class="nav-link-title">Blog</span>
                            </a>
                        </div>

                        @if (auth()->user()->role == 'admin')
                            <div class="nav-item">
                                <a class="nav-link " href="{{ route('user.index') }}" data-placement="left">
                                    <i class="bi-people nav-icon"></i>
                                    <span class="nav-link-title">User</span>
                                </a>
                            </div>
                        @endif

                        <div class="dropdown-divider"></div>



                        <div class="nav-item">
                            <!-- Log Out Link -->
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); disableLogout(); document.getElementById('logout-form').submit();"
                                data-placement="left">
                                <i class="bi-box-arrow-right nav-icon"></i>
                                <span class="nav-link-title">Log Out</span>
                            </a>

                            <!-- Hidden Log Out Form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>


                    </div>
                </div>
                <!-- End Collapse -->






            </div>

        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="navbar-vertical-footer">
            <ul class="navbar-vertical-footer-list">
                <li class="navbar-vertical-footer-list-item">
                    <!-- Style Switcher -->
                    <div class="dropdown dropup">
                        <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                            id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            data-bs-dropdown-animation>

                        </button>

                        <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"
                            aria-labelledby="selectThemeDropdown">
                            <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                                <i class="bi-moon-stars me-2"></i>
                                <span class="text-truncate" title="Auto (system default)">Auto (system
                                    default)</span>
                            </a>
                            <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                                <i class="bi-brightness-high me-2"></i>
                                <span class="text-truncate" title="Default (light mode)">Default (light
                                    mode)</span>
                            </a>
                            <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                                <i class="bi-moon me-2"></i>
                                <span class="text-truncate" title="Dark">Dark</span>
                            </a>
                        </div>
                    </div>

                </li>


            </ul>
        </div>
    </div>
    </div>
</aside>
<script>
    function disableLogout() {
        const logoutLink = document.querySelector('a.nav-link[href="{{ route('logout') }}"]');
        logoutLink.style.pointerEvents = 'none';
        logoutLink.style.opacity = '0.5';
    }
</script>
