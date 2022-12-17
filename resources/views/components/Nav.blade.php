<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Gadget<span class="text-danger">On</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(Auth::check() && Auth::user()->isAdmin == true)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage Products
                        </a>
                        <ul class="dropdown-menu dropdown">
                            <li><a class="dropdown-item" href="{{ route('addProduct') }}">Add Products</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin') }}">Manage Products</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item" style="min-width: 75px">
                        <a class="nav-link text-decoration-none text-dark" href="{{ route('MyCart') }}">
                            My Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none text-dark" href="{{ route('History') }}">
                           History
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="d-flex navbar-nav w-100 ps-2 justify-content-between">
                <form class="d-flex flex-fill" role="search" method="GET" action="{{ route('home') }}">
                    @csrf
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="align-self-lg-center nav-item dropdown" style="min-width: 230px;">
                    @if(Auth::check())
                        <a href="" role="button" class="text-decoration-none text-dark px-2" data-bs-toggle="dropdown">
                            <img src="{{ asset('storage/user-image/'.auth()->user()->image) }}" class="img-fluid rounded-circle overflow-hidden" alt="" style="width: 40px; height: 40px;">
                            {{ Auth::user()->name }}
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </a>
                        <div class="mx-lg-5 navbar-item dropdown-menu">
                            <a href="{{ route('profile.show') }}" class="text-decoration-none text-dark px-2">
                                <i class="bi bi-person"></i>
                                Profile
                            </a>
                            <li><hr class="dropdown-divider"></li>
                            <a href="{{ route('logout') }}" class="text-decoration-none text-dark px-2">
                                <i class="bi bi-box-arrow-left"></i>
                                Logout
                            </a>
                        </div>
                        @else
                        <div class="mx-lg-5 navbar-item">
                            <a href="/login" class="text-decoration-none text-dark px-2">Login</a>
                            <a href="/register" class="text-decoration-none text-dark px-2">Register</a>
                        </div>
                    @endif
                </div>
            </ul>
        </div>
    </div>
</nav>

