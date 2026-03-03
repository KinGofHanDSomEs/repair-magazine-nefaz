@extends('layouts.app')

@section('title', 'Просмотр пользователя')

@vite([
    'resources/css/users.css',
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center items-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-3">
            <h1 class="font-bold text-xl text-center c3">Пользователь №{{ $user->id }}</h1>

            <a href="{{ route('users.index') }}"
               class="absolute font-bold left-0 c4">Все пользователи</a>
        </div>

        <x-error />

        <div class="order-container text-lg min-w-100 c2 flex flex-col border border-c2 rounded-2xl mb-3">
            <x-group-text title="Почта">
                <p>{{ $user->email }}</p>
            </x-group-text>

            <x-group-text title="Имя" bg="bgt3">
                <p>{{ $user->name }}</p>
            </x-group-text>

            <x-group-text title="Фамилия">
                <p>{{ $user->lastname }}</p>
            </x-group-text>

            <x-group-text title="Номер" bg="bgt3">
                <p>{{ $user->phone }}</p>
            </x-group-text>

            <x-group-text title="Подтверждено">
                @if($user->isConfirmed())
                    <p class="text-green-600">Да</p>
                @else
                    <p class="text-red-600">Нет</p>
                @endif
            </x-group-text>

            <x-group-text title="Дата создания" bg="bgt3">
                <p>{{ $user->created_at }}</p>
            </x-group-text>

            <x-group-text title="Дата обновления" mb="0">
                <p>{{ $user->updated_at }}</p>
            </x-group-text>
        </div>

        <div class="btns flex flex-col justify-between text-lg w-100">
            <div class="flex flex-row justify-between">
                <a href="{{ route('users.edit', $user->id) }}">Изменить</a>

                @if(!$user->isConfirmed())
                    <form action="{{ route('users.confirm', $user->id) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <button class="cursor-pointer">Подтвердить</button>
                    </form>
                @endif

                @if(!count($user->orders))
                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="cursor-pointer">Удалить</button>
                    </form>
                @endif
            </div>

            <a href="{{ route('users.index') }}" class="font-bold self-center text-base c4 mt-3">Все пользователи</a>
        </div>
    </div>
@endsection
