 <!-- main header @s -->
 <div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo2x.png') }}
                    2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dark.png') }}" srcset="{{ asset('assets/images/logo-dark2x.png') }}
                    2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                   <span class="sm">{{ strtoupper(substr(Auth::user()->nama_pengguna, 0, 3)) }}</span>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status user-status-verified">Online</div>
                                    <div class="user-name dropdown-indicator">{{ Auth::user()->nama_pengguna }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>{{ strtoupper(substr(Auth::user()->nama_pengguna, 0, 3)) }}</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->nama_pengguna }}</span>
                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('profile.index') }}" ><em class="icon ni ni-user-alt" ></em><span>View Profile</span></a></li>
                                    @if(Auth::user()->level == 'admin')
                                    <li><a href="{{ route('setting.index') }}"><em class="icon ni ni-setting-alt"></em><span>Setting</span></a></li>
                                    <li><a href="{{ route('log.user') }}"><em class="icon ni ni-activity-alt"></em><span>Aktivitas Login</span></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <form id="logout-form" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                                <ul class="link-list">
                                    <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->
