@extends('layouts.app')

@section('title', 'Аутентификация')

@vite([
    'resources/css/auth.css'
])

@section('main')
<div class="c2 border-c5 container mx-auto my-10 max-w-96 py-3 flex flex-col justify-center border-2 rounded-2xl">
    <div class="heading">
        <h1 class="font-bold text-xl text-center c3">Вход</h1>
    </div>

    <form method="post" action="{{ route('login') }}" class="flex flex-col px-3">
        @csrf

        <x-error field="error" />

        <x-group-input name="email" type="email" text="Электронная почта">
            <x-error field="email" />
        </x-group-input>

        <x-group-input name="password" type="password" text="Пароль" withValue="">
            <x-error field="password" />

            <x-form-link href="#">Забыли пароль?</x-form-link>
        </x-group-input>

        <x-form-button>Войти</x-form-button>

        <x-form-link href="{{ route('register') }}" align="text-center">Нет аккаунта?</x-form-link>
    </form>
</div>
@endsection
