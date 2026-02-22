<div class="container mx-auto py-3 flex flex-row justify-between items-center">
    <a href="{{ route('index') }}" class="logo flex flex-row items-center">
        <img src="{{ asset('images/icons/nefaz-logo.svg') }}" alt="logo nefaz" class="h-6">
    </a>


    <div class="links flex flex-row justify-center">
        <nav class="c1 flex flex-row">
            <a href="{{ route('index') }}" class="transition-colors mr-8">Главная</a>
            <a href="{{ route('orders') }}" class="transition-colors mr-8">Заказы</a>
        </nav>

        <div class="auth ml-8 flex justify-center items-center">
            @if(!Auth::check())
                <a href="{{ route('login') }}" class="c1 font-bold transition-colors ml-2">Войти</a>
            @else
                <a href="{{ route('profile') }}">
                    <img src="{{ asset('images/icons/profile.svg') }}" alt="profile icon" class="h-5 w-5">
                </a>
            @endif
        </div>
    </div>
</div>
