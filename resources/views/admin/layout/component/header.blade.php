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
            <div class="nk-header-search ms-3 ms-xl-0">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
            </div><!-- .nk-header-news -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    
                    <li class="dropdown chats-dropdown hide-mb-xs">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                <a href="#">Setting</a>
                            </div>
                            <div class="dropdown-body">
                                <ul class="chat-list">
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar">
                                                <span>IH</span>
                                                <span class="status dot dot-lg dot-gray"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">Iliash Hossain</div>
                                                    <span class="time">Now</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">You: Please confrim if you got my last messages.</div>
                                                    <div class="status delivered">
                                                        <em class="icon ni ni-check-circle-fill"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- .chat-item -->
                                </ul><!-- .chat-list -->
                            </div><!-- .nk-dropdown-body -->
                        </div>
                    </li>
                    <li class="dropdown notification-dropdown">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                <a href="#">Mark All as Read</a>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                </div><!-- .nk-notification -->
                            </div><!-- .nk-dropdown-body -->
                        </div>
                    </li>
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
                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
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