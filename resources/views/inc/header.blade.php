<div class="container mx-auto py-3 flex flex-row justify-between items-center">
    <a href="{{ route('index') }}" class="logo flex flex-row items-center">
        <img src="{{ asset('images/icons/nefaz-logo.svg') }}" alt="logo nefaz" class="h-6">
    </a>

    <div class="links flex flex-row justify-center">
        <nav class="flex flex-row justify-center items-center">
            <a href="{{ route('index') }}" class="transition-colors mr-6">Главная</a>
            <a href="{{ route('orders.index') }}" class="transition-colors mr-6">Заказы</a>

            @if(Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('users.index') }}" class="transition-colors mr-6">Пользователи</a>
            @endif
        </nav>

        <div class="auth ml-6 flex justify-center items-center">
            @if(!Auth::check())
                <a href="{{ route('login') }}" class="text-lg transition-colors ml-2">Войти</a>
            @else
                <a href="{{ route('auth.profile') }}">
                    <svg
                        class="h-5 w-5"
                        id="profile-svg"
                        viewBox="0 0 20 20">

                        <title>Профиль</title>

                        <g
                            transform="translate(-380.000000, -2159.000000)"
                            fill="#000000"
                            style="fill:#fff">
                            <g
                                transform="translate(56.000000, 160.000000)"
                                style="fill:#fff">
                                <path
                                    d="M334,2011 C337.785,2011 340.958,2013.214 341.784,2017 L326.216,2017 C327.042,2013.214 330.215,2011 334,2011 M330,2005 C330,2002.794 331.794,2001 334,2001 C336.206,2001 338,2002.794 338,2005 C338,2007.206 336.206,2009 334,2009 C331.794,2009 330,2007.206 330,2005 M337.758,2009.673 C339.124,2008.574 340,2006.89 340,2005 C340,2001.686 337.314,1999 334,1999 C330.686,1999 328,2001.686 328,2005 C328,2006.89 328.876,2008.574 330.242,2009.673 C326.583,2011.048 324,2014.445 324,2019 L344,2019 C344,2014.445 341.417,2011.048 337.758,2009.673"
                                    id="color"
                                    style="fill:#fff" />
                            </g>
                        </g>
                    </svg>
                </a>
            @endif
        </div>

        <div class="ml-6 flex justify-center items-center">
            <svg
                class="cursor-pointer h-5.5 w-5.5"
                viewBox="0 0 24 24"
                id="theme-btn">

                <title>Тема</title>

                <path
                    d="M12,22 C17.5228475,22 22,17.5228475 22,12 C22,6.4771525 17.5228475,2 12,2 C6.4771525,2 2,6.4771525 2,12 C2,17.5228475 6.4771525,22 12,22 Z M12,20.5 L12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 Z"
                    id="color"
                    style="fill:#000" />
            </svg>
        </div>
    </div>
</div>
