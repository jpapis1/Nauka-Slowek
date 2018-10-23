<div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">

    </ul>
    @if (session()->has('loggedUser'))
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/login">{{'Profil ' . session('loggedUser')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/logout">Wyloguj się</a>
                </li>

            </ul>
        </form>
    @else
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/register">Zarejestruj się</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/projekt/public/login">Zaloguj się</a>
                </li>

            </ul>
        </form>
    @endif

</div>