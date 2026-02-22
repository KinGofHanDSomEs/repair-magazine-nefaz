@extends('layouts.app')

@section('title', 'Аутентификация')

@vite([
    'resources/css/auth.css'
])

@section('main')
<div class="container mx-auto my-10 max-w-96 py-3 flex flex-col justify-center border-2 rounded-2xl c4 border-c2">
    <h1 class="c3 font-bold text-2xl text-center">Вход</h1>

    <form method="post" action="{{ route('auth.login') }}" class="flex flex-col px-3">
        @csrf

        @error('global')
            <div class="text-red-600 my-2 text-sm">{{ $message }}</div>
        @enderror

        <div class="group-input flex flex-col mt-2">
            <label for="email" class="mb-1">Электронная почта</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   class="text-lg border border-c2 py-1 px-2 rounded-xl outline-none transition-colors @error('email') border-red-600! @enderror" required>

            @error('email')
                <div class="text-red-600 mt-0.5 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="group-input flex flex-col mt-4">
            <label for="password" class="mb-1">Пароль</label>
            <input type="password" id="password" name="password"
                   class="text-lg border py-1 px-2 rounded-xl outline-none transition-colors @error('email') border-red-600! @enderror" required>

            @error('password')
                <div class="text-red-600 mt-0.5 text-sm">{{ $message }}</div>
            @enderror

            <a href="#" class="text-sm c3 mt-2 transition-colors">Забыли пароль?</a>
        </div>

        <button class="mt-5 border rounded-xl self-center px-20 py-1 text-lg cursor-pointer transition-colors">Войти</button>
        <a href="{{ route('register') }}" class="text-center text-sm c3 mt-1 transition-colors">Нет аккаунта?</a>
    </form>
</div>
@endsection
