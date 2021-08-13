<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/home') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>

                @if (Auth::user()->role == 3)
                    <li class="nav-small-cap"><span class="hide-menu">Buat Ticket</span></li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('user/ticket/create') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Kirim Ticket Baru
                            </span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Tracking Status Ticket</span></li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('user/ticket/pending') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Pending
                            </span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('user/ticket/progress') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Progress
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('user/ticket/complete') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Complete
                            </span>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->role == 2 || Auth::user()->role == 1)

                    <li class="nav-small-cap"><span class="hide-menu">Tracking Status Ticket</span></li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('process/ticket/pending') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Pending
                            </span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('process/ticket/progress') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Progress
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('process/ticket/complete') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Complete
                            </span>
                        </a>
                    </li>

                    @if (Auth::user()->role == 1)
                        <li class="nav-small-cap"><span class="hide-menu">Karyawan & User</span></li>

                        <li class="sidebar-item active">
                            <a class="sidebar-link" href="{{ URL('karyawan/tambah') }}" aria-expanded="false">
                                <i data-feather="tag" class="feather-icon"></i>
                                <span class="hide-menu">Tambah User
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a class="sidebar-link" href="{{ URL('karyawan/manage') }}" aria-expanded="false">
                                <i data-feather="tag" class="feather-icon"></i>
                                <span class="hide-menu">Manage User
                                </span>
                            </a>
                        </li>

                    @endif

                @endif


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
