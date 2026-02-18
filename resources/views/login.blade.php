@extends('layouts.app')

@vite([
    'resources/js/auth.js'
])

@section('main')

<form method="post" action="{{ route('auth.login') }}">
    @csrf

    @error('global')
        <div class="error-message">{{ $message }}</div>
    @enderror

    <label for="email">Электронная почта</label>
    <input type="email" id="email" name="email" placeholder="email@example.com" value="{{ old('email') }}"
           class="@error('email') is-invalid @enderror">
    @error('email')
        <div class="error-message">{{ $message }}</div>
    @enderror

    <label for="password">Пароль</label>
    <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror">
    @error('password')
        <div class="error-message">{{ $message }}</div>
    @enderror


    <button>Войти</button>
    <a href="{{ route('register') }}">Нет аккаунта?</a>
    <a href="#">Забыли пароль?</a>
</form>
@endsection
