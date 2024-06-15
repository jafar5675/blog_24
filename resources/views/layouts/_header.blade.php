<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ asset('frontend') }}/assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Learning Aids</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            @php
                $getCategoryHeader = App\Models\Category::getCategoryMenu();
            @endphp
            <ul>
                <li><a href="{{ url('') }}"
                        class="nav-item nav-link @if (Request::segment(1) == '') active @endif">Home</a></li>
                @foreach ($getCategoryHeader as $categoryHeader)
                    <li><a class="nav-item nav-link @if (Request::segment(1) == $categoryHeader->slug) active @endif"
                            href="{{ url($categoryHeader->slug) }}">{{ $categoryHeader->name }}</a></li>
                @endforeach
                {{-- <li><a href="{{ url('courses') }}">Courses</a></li>
                <li><a href="{{ url('teachers') }}">Teachers</a></li>
                <li><a href="{{ url('blog') }}">Blog</a></li>
                <li><a href="{{ url('price') }}">Pricing</a></li>
                <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li> --}}
                <li><a href="{{ url('contact') }}">Contact</a></li>
                <li>
                    <a class="" style="padding:2px;" href="{{ url('login') }}">Login</a>
                </li>
                <li>
                    <a class="" style="padding:2px; margin-left:10px;" href="{{ url('register') }}">Register</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
