<div class="row header-wrapper">
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">NBA Info</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teams.index') }}">Teams</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">My&nbsp;<i class="fas fa-heart"></i>&nbsp;teams</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('players.index') }}">Players</a>
                    </li>
                </ul>
                @guest
                    <button class="btn">
                        <a class="nav-link" href="{{ route('login') }}">SignIn</a>
                    </button>
                    <button class="btn">
                        <a class="nav-link" href="{{ route('register') }}">SignUp</a>
                    </button>
                @endguest
                @auth
                    <button class="btn">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           Log out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </button>
                @endauth
            </div>
        </nav>

    </header>
</div>
