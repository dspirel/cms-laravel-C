@inject('nav', 'App\Helpers\Navigation' )

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">News</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                @if (Route::is('dashboard.*'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.pages.index') }}">Pages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.users.index') }}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.roles.index') }}">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.navigation.index') }}">Navigation</a>
                        </li>
                @else
                    @foreach ($nav->getLinks() as $link)
                        <li class="nav-item">
                            <a class="nav-link" href="/nav/{{ $link->name }}"> {{ $link->name }} </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 pe-5">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard.show') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.show') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register.show') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
