@extends('layouts.app')

@section('title', 'Заказы')

@vite([
    'resources/css/orders.css'
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center items-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-4">
            <h1 class="font-bold text-xl text-center c3">Заказы</h1>

            @if(Auth::user()->isConfirmed())
                <a href="{{ route('orders.create') }}" title="Добавить" class="add-btn absolute font-bold text-lg right-0 top-0 bg3 c1 px-2 rounded-xl">+</a>
            @endif
        </div>

        <x-error />

        @if(!Auth::user()->isConfirmed())
            <h2 class="text-xl text-red-600 italic text-center">Ваш аккаунт еще не подтвержден администратором!</h2>
        @elseif(!count($orders))
            <h2 class="text-xl text-red-600 italic text-center">Заказов нет</h2>
        @else
            <div class="orders-container w-full rounded-2xl border border-c5 overflow-hidden">
                <table class="border-collapse w-full border-none text-xs c2">
                    <thead>
                        <tr class="border-b border-c5 bg4">
                            <th class="py-1">Номер</th>

                            @if(Auth::user()->isAdmin())
                                <th>Почта</th>
                            @endif

                            <th>Техника</th>
                            <th>Модель</th>
                            <th>Кол-во</th>
                            <th>Статус</th>
                            <th>Цена</th>
                            <th>Оплата</th>
                            <th>Cоздано</th>
                            <th>Завершено</th>
                            <th>Примечание</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr class="not-last:border-b border-c5">
                                <td class="text-center py-1">{{ $order->id }}</td>

                                @if(Auth::user()->isAdmin())
                                    <td class="text-center">{{ $order->user->email }}</td>
                                @endif

                                <td class="text-center">{{ $order->type->technic->name }}</td>

                                <td class="text-center">{{ $order->type->model }}</td>

                                <td class="text-center">{{ $order->count }}</td>


                                <td class="text-center
                                    @switch($order->status)
                                        @case('Проверяется') c5 @break
                                        @case('Выполняется') italic c3 @break
                                        @case('Завершено') text-green-600 @break
                                        @case('Ошибка') text-red-600 @break
                                    @endswitch">{{ $order->status }}
                                </td>

                                @if(is_null($order->price))
                                    <td class="c5 text-center">Нет</td>
                                @else
                                    <td class="text-center">{{ $order->price }}₽</td>
                                @endif

                                <td class="text-center @switch($order->payment_status)
                                        @case('Успешно') text-green-600 @break
                                        @case('Ошибка') text-red-600 @break
                                    @endswitch">{{ $order->payment_status }}</td>

                                <td class="text-center">{{ $order->created_at }}</td>

                                @if(is_null($order->completed_at))
                                    <td class="c5 text-center">Нет</td>
                                @else
                                    <td class="text-center">{{ $order->completed_at }}</td>
                                @endif

                                @if(is_null($order->failed_message))
                                    <td class="c5 text-center">Пусто</td>
                                @else
                                    <td class="text-red-600 text-center">{{ $order->failed_message }}</td>
                                @endif

                                <td class="border-x border-c5 text-center"><a href="{{ route('orders.show', $order->id) }}" title="Подробнее" class="px-2 c4">👁</a></td>

                                @switch($order->status)
                                    @case('Проверяется')
                                    @case('Оценено')
                                    @case('Ошибка')
                                        @if($order->payment_status !== 'Успешно')
                                            <td class="border-l border-c5 text-center"><a href="{{ route('orders.edit', ['order' => $order->id, 'technicId' => $order->type->technic->id]) }}" title="Изменить" class="font-bold px-2 c3">+</a></td>
                                            <td class="border-l border-c5 text-center">
                                                <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button title="Удалить" class="font-bold cursor-pointer px-2 text-red-600">−</button>
                                                </form>
                                            </td>
                                        @endif
                                        @break
                                    @default
                                        <td></td>
                                        <td></td>
                                @endswitch
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
