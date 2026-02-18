
<div class="logo">
    <picture>
        <img src="" alt="logo">
    </picture>
    <h1>НЕФАЗ</h1>
</div>

<nav>
    <ul>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
    </ul>
</nav>

<div class="auth">
    @if(!Auth::check()) <a href="{{ route('login') }}">Войти</a> @else <a href="{{ route('profile') }}">Профиль</a> @endif
</div>
