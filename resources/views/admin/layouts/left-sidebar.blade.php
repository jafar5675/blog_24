<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('admin/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->is_admin == 1)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'user') collapsed @endif"
                    href="{{ url('admin/user/list') }}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'category') collapsed @endif"
                    href="{{ url('admin/category/list') }}">
                    <i class="bi bi-question-circle"></i>
                    <span>Category</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) != 'blog') collapsed @endif" href="{{ url('admin/blog/list') }}">
                <i class="bi bi-envelope"></i>
                <span>Blog</span>
            </a>
        </li>
        @if (Auth::user()->is_admin == 1)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'page') collapsed @endif"
                    href="{{ url('admin/page/list') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Page</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) != 'change-password') collapsed @endif"
                href="{{ url('admin/change-password') }}">
                <i class="bi bi-key"></i>
                <span>Change Password</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('logout') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
