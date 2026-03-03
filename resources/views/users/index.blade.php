@extends('layouts.app')

@section('title', 'Пользователи')

@vite([
    'resources/css/users.css',
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center items-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-4">
            <h1 class="font-bold text-xl text-center c3">Пользователи</h1>

            <a href="{{ route('users.create') }}" title="Добавить" class="add-btn absolute font-bold text-lg right-0 top-0 bg3 c1 px-2 rounded-xl">+</a>
        </div>

        <x-error />

        @if(!count($users))
            <h2 class="text-xl text-red-600 italic text-center">Пользователей нет</h2>
        @else
            <div class="users-container w-full rounded-2xl border border-c5 overflow-hidden">
                <table class="border-collapse w-full border-none text-xs c2">
                    <thead>
                        <tr class="border-b border-c5 bg4">
                            <th class="py-1">Номер</th>
                            <th>Почта</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Номер</th>
                            <th>Подтвержден</th>
                            <th>Создан</th>
                            <th>Обновлен</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr class="not-last:border-b border-c5">
                                <td class="text-center py-1">{{ $user->id }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->lastname }}</td>
                                <td class="text-center">{{ $user->phone }}</td>

                                @if($user->confirmed)
                                    <td class="text-center text-green-600">Да</td>
                                @else
                                    <td class="text-center text-red-600">Нет</td>
                                @endif

                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">{{ $user->updated_at }}</td>

                                <td class="border-x border-c5 text-center"><a href="{{ route('users.show', $user->id) }}" title="Подробнее" class="c4">👁</a></td>
                                <td class="border-l border-c5 text-center border-x"><a href="{{ route('users.edit', $user->id) }}" title="Изменить" class="font-bold c3">+</a></td>
                                @if(!count($user->orders))
                                    <td class="border-l border-c5 text-center">
                                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button title="Удалить" class="font-bold cursor-pointer text-red-600">−</button>
                                        </form>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
