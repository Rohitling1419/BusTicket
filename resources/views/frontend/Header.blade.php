<nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm" style="height:80px;">
    <div class="container">

        <a class="navbar-brand" href="/">
            <u>
                ChittoBus
            </u>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blog')}}">Blog</a>
                </li>

                <!-- Check if user is logged in -->
                @guest
                <li class="nav-item ms-2">
                    <a class="btn auth-btn login-btn" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn auth-btn" href="{{ route('register') }}">Register</a>
                </li>
                @else
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fa fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('user.booking.history')}}">
                                <i class="fa fa-history me-2"></i> Booking History
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt me-2"></i> Logout
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

    <script>
        // Add scrolled class to navbar when scrolling
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar').classList.add('scrolled');
            } else {
                document.getElementById('navbar').classList.remove('scrolled');
            }
        });
    </script>
    <style>
        #navbar {
            background: linear-gradient(to right, #2c3e50, #994bb7);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        #navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-toggler {
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 10px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 8px 15px !important;
            border-radius: 5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #f5b041;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 70%;
        }

        .auth-btn {
            background-color: #f5b041;
            color: #2c3e50 !important;
            font-weight: 600;
            padding: 8px 20px !important;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid #f5b041;
        }

        .auth-btn:hover {
            background-color: transparent;
            color: #f5b041 !important;
        }

        .login-btn {
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white !important;
        }

        .login-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: white;
        }

        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 10px;
            min-width: 200px;
            margin-top: 15px;
        }

        .dropdown-item {
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #4b6cb7;
            transform: translateX(5px);
        }

        .dropdown-item.logout {
            color: #e74c3c;
        }

        .dropdown-item.logout:hover {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: #2c3e50;
                border-radius: 10px;
                padding: 20px;
                margin-top: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .nav-link::after {
                display: none;
            }

            .auth-btn {
                margin-top: 10px;
                display: block;
                text-align: center;
            }
        }
    </style>
</nav>