<!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo2x.png ') }}2x" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dark.png') }}" srcset="{{ asset('assets/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/images/logo-small.png') }}" srcset="{{ asset('assets/images/logo-small2x.png') }} 2x" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Dashboard</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Menu</h6>
                                </li><!-- .nk-menu-heading -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                                        <span class="nk-menu-text">Data barang</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('databarang.index') }}" class="nk-menu-link"><span class="nk-menu-text">Table Barang</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('Kategory.index') }}" class="nk-menu-link"><span class="nk-menu-text">Table Kategory</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-percent"></em></span>
                                        <span class="nk-menu-text">Diskon / Potongan</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('potongan.index') }}" class="nk-menu-link"><span class="nk-menu-text">Potongan Harga</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('diskon.index') }}" class="nk-menu-link"><span class="nk-menu-text">Diskon Barang</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ route('Transaksi.index') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-cart"></em></span>
                                        <span class="nk-menu-text">Transaksi</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                                        <span class="nk-menu-text">User</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('UserData.index') }}" class="nk-menu-link"><span class="nk-menu-text">Data Pengguna</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('log.user') }}" class="nk-menu-link"><span class="nk-menu-text">Riwayat Login Pengguna</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link"><span class="nk-menu-text">Profile Pengguna</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                                        <span class="nk-menu-text">Generate Laporan</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link"><span class="nk-menu-text">Laporan Penjualan</span></a>
                                        </li>
                                        {{-- <li class="nk-menu-item">
                                            <a href="{{ route('Kategory.index') }}" class="nk-menu-link"><span class="nk-menu-text">Riwayat Login Pengguna</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('Kategory.index') }}" class="nk-menu-link"><span class="nk-menu-text">Profile Pengguna</span></a>
                                        </li> --}}
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Setting</h6>
                                </li><!-- .nk-menu-heading -->
                                
                                <li class="nk-menu-item">
                                    <a href="html/components/misc/icons.html" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                        <span class="nk-menu-text">Setting</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->