@extends('layouts.app')

@section('title', 'Просмотр заказа')

@vite([
    'resources/css/orders.css',
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center items-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-3">
            <h1 class="font-bold text-xl text-center c3">Заказ №{{ $order->id }}</h1>

            <a href="{{ route('orders.index') }}"
               class="absolute font-bold left-0 c4">Все заказы</a>
        </div>

        <x-error />

        <div class="order-container text-lg min-w-100 c2 flex flex-col border border-c2 rounded-2xl mb-3">
            @if (Auth::user()->isAdmin())
                <x-group-text title="Почта" bg="bgt3">
                    <p>{{ $order->user->email }}</p>
                </x-group-text>
            @endif

            <x-group-text title="Техника">
                <p>{{ $order->type->technic->name }}</p>
            </x-group-text>

            <x-group-text title="Модель" bg="bgt3">
                <p>{{ $order->type->model }}</p>
            </x-group-text>

            <x-group-text title="Количество">
                <p>{{ $order->count }}</p>
            </x-group-text>

            <x-group-text title="Статус заказа" bg="bgt3">
                <p class="
                @switch($order->status)
                    @case('Проверяется') c5 @break
                    @case('Выполняется') italic c3 @break
                    @case('Завершено') text-green-600 @break
                    @case('Ошибка') text-red-600 @break
                @endswitch">{{ $order->status }}</p>
            </x-group-text>

            <x-group-text title="Цена">
                @if(is_null($order->price))
                    <p class="c5">Нет</p>
                @else
                    <p>{{ $order->price }}₽</p>
                @endif
            </x-group-text>

            <x-group-text title="Статус оплаты" bg="bgt3">
                <p class="
                    @switch($order->payment_status)
                        @case('Успешно') text-green-600 @break
                        @case('Ошибка') text-red-600 @break
                    @endswitch">{{ $order->payment_status }}</p>
            </x-group-text>

            <x-group-text title="Дата создания">
                <p>{{ $order->created_at }}</p>
            </x-group-text>

            <x-group-text title="Дата завершения" bg="bgt3">
                @if(is_null($order->completed_at))
                    <p class="c5">Нет</p>
                @else
                    <p>{{ $order->completed_at }}</p>
                @endif
            </x-group-text>

            <x-group-text title="Примечание" mb="0">
                @if(is_null($order->failed_message))
                    <p class="c5">Пусто</p>
                @else
                    <p class="text-red-600">{{ $order->failed_message }}</p>
                @endif
            </x-group-text>
        </div>

        @if(Auth::user()->isAdmin())
            @if($order->status === 'Проверяется')
                <div class="admin-btns flex flex-row justify-between border rounded-2xl mb-2 p-3 w-100">
                    <form method="post" action="{{ route('orders.rate', $order->id) }}" class="flex flex-col w-1/3">
                        @csrf
                        @method('PATCH')

                        <input type="number" name="price" placeholder="Цена" value="{{ old('price') }}" class="outline-none rounded-2xl py-1 px-2 border border-c5 transition-colors placeholder:text-sm" min="1" required>
                        <x-error field="price" />

                        <button class="cursor-pointer mt-1 self-start text-green-600">Оценить</button>
                    </form>

                    <form method="post" action="{{ route('orders.revoke', $order->id) }}" class="flex flex-col w-5/8">
                        @csrf
                        @method('PATCH')

                        <textarea name="failed_message" cols="30" rows="1" placeholder="Примечание" class="outline-none rounded-2xl py-1 px-2 border border-c5 transition-colors placeholder:text-sm" required>{{ old('failed_message') }}</textarea>
                        <x-error field="failed_message" />

                        <button class="cursor-pointer mt-1 self-end text-red-600">Отменить</button>
                    </form>
                </div>
            @elseif($order->status === 'Выполняется')
                <form method="post" action="{{ route('orders.complete', $order->id) }}" class="flex flex-col border rounded-2xl w-100 mb-2 p-3">
                    @csrf
                    @method('PATCH')

                    <button class="cursor-pointer self-center text-green-600">Завершить</button>
                </form>
            @elseif($order->status !== 'Завершено' && $order->payment_status === 'Успешно')
                <form method="post" action="{{ route('orders.start', $order->id) }}" class="flex flex-col border rounded-2xl w-100 mb-2 p-3">
                    @csrf
                    @method('PATCH')

                    <button class="cursor-pointer self-center c3">Начать</button>
                </form>
            @endif
        @endif

        <div class="btns flex flex-col justify-between text-lg w-100">
            @switch($order->status)
                @case('Проверяется')
                @case('Ошибка')
                    @if($order->payment_status !== 'Успешно')
                        <div class="flex flex-row justify-between">
                            <a href="{{ route('orders.edit', $order->id) }}">Изменить</a>

                            <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="cursor-pointer">Удалить</button>
                            </form>
                        </div>
                    @endif
            @endswitch

            @if($order->status === 'Оценено' && $order->payment_status !== 'Успешно')
                <form method="post" action="{{ route('orders.pay', $order->id) }}" class="flex justify-center">
                    @csrf

                    <button class="text-lg cursor-pointer">Оплатить</button>
                </form>
            @endif

            <a href="{{ route('orders.index') }}" class="font-bold self-center text-base c4 mt-3">Все заказы</a>
        </div>
    </div>
@endsection
