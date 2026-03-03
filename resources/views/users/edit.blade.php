@extends('layouts.app')

@section('title', 'Изменение пользователя')

@vite([
    'resources/css/users.css',
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center items-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-4">
            <h1 class="font-bold text-xl text-center c3">Изменение пользователя №{{ $user->id }}</h1>

            <a href="{{ route('users.index') }}"
               class="absolute font-bold left-0 c4">Все пользователи</a>
        </div>

        <x-error field="error" />

        <form method="post" action="{{ route('users.update', $user->id) }}" class="update-form min-w-80 flex flex-col justify-center border rounded-2xl pt-0 p-3">
            @csrf
            @method('PATCH')

            <x-group-input name="email" type="email" text="Почта" value="{{ $user->email }}" placeholder="email@example.com" req="">
                <x-error field="email" />
            </x-group-input>

            <x-group-input name="password" type="password" text="Пароль" withValue="" placeholder="Не менее 8 символов" req="">
                <x-error field="password" />
            </x-group-input>

            <x-group-input name="name" type="text" text="Имя" value="{{ $user->name }}" req="">
                <x-error field="name" />
            </x-group-input>

            <x-group-input name="lastname" type="text" text="Фамилия" value="{{ $user->lastname }}" req="">
                <x-error field="lastname" />
            </x-group-input>

            <x-group-input name="phone" type="text" text="Номер" value="{{ $user->phone }}" placeholder="8-999-999-9999" req="">
                <x-error field="phone" />
            </x-group-input>

            <x-form-button>Изменить</x-form-button>
        </form>

        <a href="{{ route('users.index') }}" class="font-bold self-center text-base mt-3 text-red-600">Отмена</a>
    </div>
@endsection
