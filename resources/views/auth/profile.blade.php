@php use App\Constants\Errors\ValidationErrors; @endphp
@extends('layouts.app')

@section('title', 'Профиль')

@vite([
    'resources/css/auth.css',
    'resources/js/profile.js'
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center items-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-3">
            <h1 class="font-bold text-xl text-center c3">Личный кабинет</h1>

            <a href="{{ route('logout') }}"
               class="absolute font-bold right-0 text-red-600">Выйти</a>
        </div>

        <x-error/>

        <div class="information border rounded-2xl w-full p-3">
            <div class="info mb-2">
                <div class="title flex flex-row items-center">
                    <p class="font-bold">Почта</p>
                </div>

                <div class="value">
                    <p class="text-lg">{{ $user->email }}</p>
                </div>
            </div>

            <div class="info mb-2">
                <div class="title flex flex-row items-center">
                    <p class="font-bold">Имя</p>
                    <p class="change c3 italic text-sm ml-3 cursor-pointer transition-colors">Изменить</p>
                </div>

                <div class="value">
                    <p class="text-lg">{{ $user->name }}</p>

                    <form method="post" action="{{ route('auth.profile.change', $user->id) }}"
                          class="hidden! inline-flex flex-col text-sm mt-1">
                        @csrf
                        @method('PATCH')

                        <input type="text" name="name" value="{{ $user->name }}" placeholder="Новое имя"
                               class="outline-none py-1 px-2 rounded-2xl border border-c5 placeholder:text-xs">

                        <div class="btns flex flex-row justify-between mt-0.5">
                            <button class="text-green-600 cursor-pointer">Сохранить</button>
                            <p class="cancel-btn text-red-600 cursor-pointer">Отмена</p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="info mb-2">
                <div class="title flex flex-row items-center">
                    <p class="font-bold">Фамилия</p>
                    <p class="change c3 italic text-sm ml-3 cursor-pointer transition-colors">Изменить</p>
                </div>

                <div class="value">
                    <p class="text-lg">{{ $user->lastname }}</p>

                    <form method="post" action="{{ route('auth.profile.change', $user->id) }}"
                          class="hidden! inline-flex flex-col text-sm mt-1">
                        @csrf
                        @method('PATCH')

                        <input type="text" name="lastname" value="{{ $user->lastname }}" placeholder="Новая фамилия"
                               class="outline-none py-1 px-2 rounded-2xl border border-c5 placeholder:text-xs">

                        <div class="btns flex flex-row justify-between mt-0.5">
                            <button class="text-green-600 cursor-pointer">Сохранить</button>
                            <p class="cancel-btn text-red-600 cursor-pointer">Отмена</p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="info mb-2">
                <div class="title flex flex-row items-center">
                    <p class="font-bold">Номер телефона</p>
                    <p class="change c3 italic text-sm ml-3 cursor-pointer transition-colors">Изменить</p>
                </div>

                <div class="value">
                    <p class="text-lg">{{ $user->phone }}</p>

                    <form method="post" action="{{ route('auth.profile.change', $user->id) }}"
                          class="hidden! inline-flex flex-col text-sm mt-1">
                        @csrf
                        @method('PATCH')

                        <input type="text" name="phone" value="{{ $user->phone }}" placeholder="Новая фамилия"
                               class="outline-none py-1 px-2 rounded-2xl border border-c5 placeholder:text-xs">

                        <div class="btns flex flex-row justify-between mt-0.5">
                            <button class="text-green-600 cursor-pointer">Сохранить</button>
                            <p class="cancel-btn text-red-600 cursor-pointer">Отмена</p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="info" id="password-info">
                <div class="title flex flex-row items-center">
                    <p class="font-bold">Пароль</p>
                    <p class="change c3 italic text-sm ml-3 cursor-pointer transition-colors">Изменить</p>
                </div>

                <div class="value">
                    <form method="post" action="{{ route('auth.profile.changePassword', $user->id) }}"
                          class="hidden! inline-flex flex-col text-sm mt-1">
                        @csrf
                        @method('PATCH')

                        <input type="password" name="current_password" placeholder="Текущий пароль" required
                               class="outline-none py-1 px-2 rounded-2xl border border-c5 placeholder:text-xs @error('current_password') border-red-600! @enderror">
                        <x-error field="current_password"/>

                        <input type="password" name="password" placeholder="Новый пароль" required
                               class="outline-none mt-1 py-1 px-2 rounded-2xl border border-c5 placeholder:text-xs @error('password') border-red-600! @enderror">
                        <x-error field="password"/>

                        <input type="password" name="password_confirmation" placeholder="Повторите новый пароль" required
                               class="outline-none mt-1 py-1 px-2 rounded-2xl border border-c5 placeholder:text-xs @error('password') @if($message === ValidationErrors::CONFIRMED) border-red-600! @endif @enderror">
                        @error('password')
                        @if($message === ValidationErrors::CONFIRMED)
                            <div class="text-red-600 mt-0.5 text-xs">{{ $message }}</div>
                        @endif
                        @enderror

                        <div class="btns flex flex-row justify-between mt-0.5">
                            <button class="text-green-600 cursor-pointer">Сохранить</button>
                            <p class="cancel-btn text-red-600 cursor-pointer">Отмена</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
