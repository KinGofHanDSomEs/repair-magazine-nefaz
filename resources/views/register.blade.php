@php use App\Constants\Errors\ValidationErrors; @endphp
@extends('layouts.app')

@section('title', 'Регистрация')

@vite([
    'resources/css/auth.css'
])

@section('main')
    <div class="container mx-auto my-10 max-w-96 py-3 flex flex-col justify-center border-2 rounded-2xl c4 border-c2">
        <h1 class="c3 font-bold text-2xl text-center">Регистрация</h1>

        <form method="post" action="{{ route('auth.register') }}" class="flex flex-col px-3">
            @csrf

            @error('global')
            <div class="text-red-600 my-2 text-sm">{{ $message }}</div>
            @enderror

            <div class="group-input flex flex-col mt-2">
                <label for="name" class="mb-1">Имя</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="text-lg border border-c2 py-1 px-2 rounded-xl outline-none transition-colors" required>
            </div>

            <div class="group-input flex flex-col mt-2">
                <label for="lastname" class="mb-1">Фамилия</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}"
                       class="text-lg border border-c2 py-1 px-2 rounded-xl outline-none  transition-colors" required>
            </div>

            <div class="group-input flex flex-col mt-2">
                <label for="phone" class="mb-1">Номер телефона</label>
                <input type="text" id="phone" name="phone" placeholder="8-999-999-9999" value="{{ old('phone') }}"
                       class="flex text-lg border border-c2 py-1 px-2 rounded-xl outline-none transition-colors placeholder:text-sm"
                       required>
            </div>

            <div class="group-input flex flex-col mt-2">
                <label for="email" class="mb-1">Электронная почта</label>
                <input type="email" id="email" name="email" placeholder="email@example.com" value="{{ old('email') }}"
                       class="text-lg border border-c2 py-1 px-2 rounded-xl outline-none transition-colors placeholder:text-sm @error('email') border-red-600! @enderror"
                       required>

                @error('email')
                <div class="text-red-600 mt-0.5 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="group-input flex flex-col mt-4">
                <label for="password" class="mb-1">Пароль</label>
                <input type="password" id="password" name="password" placeholder="Не менее 8 символов"
                       class="text-lg border py-1 px-2 rounded-xl outline-none transition-colors placeholder:text-sm @error('password') border-red-600! @enderror"
                       required>

                @error('password')
                <div class="text-red-600 mt-0.5 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="group-input flex flex-col mt-4">
                <label for="password_confirmation" class="mb-1">Повторите пароль</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="text-lg border py-1 px-2 rounded-xl outline-none transition-colors @error('password')
                       @if($message === ValidationErrors::CONFIRMED) border-red-600! @endif @enderror" required>

                @error('password')
                    @if($message === ValidationErrors::CONFIRMED)
                        <div class="text-red-600 mt-0.5 text-sm">{{ $message }}</div>
                    @endif
                @enderror
            </div>

            <button class="mt-5 border rounded-xl self-center px-10 py-1 text-lg cursor-pointer transition-colors">
                Зарегистрироваться
            </button>
            <a href="{{ route('login') }}" class="text-center text-sm c3 mt-1 transition-colors">Аккаунт создан?</a>
        </form>
    </div>
@endsection
