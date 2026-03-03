@extends('layouts.app')

@section('title', 'Изменение заказа')

@vite([
    'resources/css/orders.css',
    'resources/js/orders.js',
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-3">
            <h1 class="font-bold text-xl text-center c3">Изменение заказа №{{ $order->id }}</h1>

            <a href="{{ route('orders.index') }}"
               class="absolute font-bold left-0 c4">Все заказы</a>
        </div>

        <x-error field="error" />

        <form method="post" action="{{ route('orders.update', $order->id) }}" class="update-form flex flex-col">
            @csrf
            @method('PUT')

            <div class="technic-selection-container mb-3">
                <p class="c2 mb-4">Выберите технику</p>

                <input type="number" name="technic_id" id="technic_id" class="hidden" value="{{ old('technic_id') }}">
                <x-error field="technic_id" />

                <div class="technics grid gap-5 grid-cols-4">
                    @foreach($technics as $technic)
                        <div id='{{ $technic->id }}' class="technic cursor-pointer flex flex-col justify-between rounded-xl p-3 @if($order->type->technic->id === $technic->id) bgt4 @else bgt5 @endif">
                            <h3 class="text-center text-xs mb-5 c2">{{ $technic->name }}</h3>
                            <img src="{{ asset($technic->image_url) }}" alt="{{ $technic->name }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="group-select mt-3 c2 flex flex-col">
                <label for="type-selection" class="mb-2">Выберите модель техники</label>

                <select name="type_id" id="type-selection" class="max-w-110 text-lg outline-none border-c5 border p-1 rounded-xl" required>
                    @foreach($technics as $technic)
                        @foreach($technic->types as $type)
                            <option value="{{ $type->id }}" technic="{{ $technic->id }}" class="text-lg @if($order->type->technic->id !== $technic->id) hidden @endif border-c5 bg1" @if(old('type_id') == $type->id) selected @elseif(!old('type_id') && $order->type_id === $type->id) selected @endif>{{ $type->model }}</option>
                        @endforeach
                    @endforeach
                </select>

                <x-error field="type_id" />
            </div>

            <x-group-input name="count" type="number" text="Количество" value="{{ $order->count }}" max_width="max-w-110" placeholder="Не больше 20">
                <x-error field="count" />
            </x-group-input>

            <x-form-button>Изменить</x-form-button>
        </form>

        <a href="{{ route('orders.index') }}" class="font-bold self-center text-base mt-3 text-red-600">Отмена</a>
    </div>
@endsection
