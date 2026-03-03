@php use App\Constants\Errors\ValidationErrors; @endphp
@extends('layouts.app')

@section('title', 'Регистрация')

@vite([
    'resources/css/auth.css'
])

@section('main')
    <div class="container c2 border-c5 mx-auto my-10 max-w-96 py-3 flex flex-col justify-center border-2 rounded-2xl">
        <div class="heading">
            <h1 class="font-bold text-xl text-center c3">Регистрация</h1>
        </div>

        <form method="post" action="{{ route('register') }}" class="flex flex-col px-3">
            @csrf

            <x-error field="error" />

            <x-group-input name="name" type="text" text="Имя" />

            <x-group-input name="lastname" type="text" text="Фамилия" />

            <x-group-input name="phone" type="text" text="Номер телефона" placeholder="8-999-999-9999" />

            <x-group-input name="email" type="email" text="Электронная почта" placeholder="email@example.com">
                <x-error field="email" />
            </x-group-input>

            <x-group-input name="password" type="password" text="Пароль" withValue="" placeholder="Не менее 8 символов">
                <x-error field="password" />
            </x-group-input>

            <div class="group-input flex flex-col mt-4">
                <label for="password_confirmation" class="mb-1">Повторите пароль</label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="text-lg border border-c5 py-1 px-2 rounded-xl outline-none transition-colors
                    @error('password') @if($message === ValidationErrors::CONFIRMED) border-red-600! @endif @enderror"
                    required
                >

                @error('password')
                    @if($message === ValidationErrors::CONFIRMED)
                        <div class="text-red-600 mt-0.5 text-xs">{{ $message }}</div>
                    @endif
                @enderror
            </div>

            <x-form-button>Зарегистрироваться</x-form-button>

            <x-form-link href="{{ route('login') }}" align="text-center">Есть аккаунт?</x-form-link>
        </form>
    </div>
@endsection
