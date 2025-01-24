<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" style="background-color: rgb(147,7,231);">
    
    <div class="container-fluid">
        <!-- Brand/Logo -->
        <a class="navbar-brand fw-bold" href="/" style="color: whitesmoke;">
            ChittoBus
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center" style="gap: 15px;">
                <li class="nav-item">
                    <a class="nav-link fw-semibold navs" href="/" style="color: white;" onmouseover="this.style.color='rgb(255,174,2)'" onmouseout="this.style.color='white'">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold navs" href="{{ route('about') }}" style="color: white;" onmouseover="this.style.color='rgb(255,174,2)'" onmouseout="this.style.color='white'">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold navs" href="{{ route('contact') }}" style="color: white;" onmouseover="this.style.color='rgb(255,174,2)'" onmouseout="this.style.color='white'">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold navs" href="{{route('blog')}}" style="color: white;" onmouseover="this.style.color='rgb(255,174,2)'" onmouseout="this.style.color='white'">Blog</a>
                </li>

                <!-- Check if user is logged in -->
                @guest
                <li class="nav-item">
                    <a class="btn" href="{{ route('login') }}" style="color: white;">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn" href="{{ route('register') }}" style="color: white;">Register</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
