@extends('layouts.app')

@section('title', 'Создание заказа')

@vite([
    'resources/css/orders.css',
    'resources/js/orders.js'
])

@section('main')
    <div class="container py-5 mx-auto c2 w-full flex flex-col justify-center">
        <div class="heading relative w-full flex flex-row justify-center items-center mb-4">
            <h1 class="font-bold text-xl text-center c3">Создание заказа</h1>

            <a href="{{ route('orders.index') }}"
               class="absolute font-bold left-0 c4">Все заказы</a>
        </div>

        <x-error field="error" />

        <form method="post" action="{{ route('orders.store') }}" class="create-form flex flex-col">
            @csrf

            @if(Auth::user()->isAdmin())
                <div class="group-select mb-3 c2 flex flex-col">
                    <label for="type-selection" class="mb-2">Выберите почту пользователя</label>

                    <select name="user_id" id="user-selection" class="max-w-110 text-lg outline-none border-c5 border p-1 rounded-xl @error('user_id') border-red-600! @enderror" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" class="text-lg border-c5 bg1" @if(old('user_id') == $user->id) selected @endif>{{ $user->email }}</option>
                        @endforeach
                    </select>

                    <x-error field="user_id" />
                </div>
            @endif

            <div class="technic-selection-container mb-3">
                <p class="c2 mb-4">Выберите технику</p>

                <input type="number" name="technic_id" id="technic_id" class="hidden" value="{{ old('technic_id') }}">
                <x-error field="technic_id" />

                <div class="technics grid gap-5 grid-cols-4">
                    @foreach($technics as $technic)
                        <div id='{{ $technic->id }}' class="technic bgt5 flex flex-col justify-between rounded-xl p-3 cursor-pointer">
                            <h3 class="text-center text-xs mb-5 c2">{{ $technic->name }}</h3>
                            <img src="{{ asset($technic->image_url) }}" alt="{{ $technic->name }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="group-select mt-3 c2 flex flex-col">
                <label for="type-selection" class="mb-2">Выберите модель техники</label>

                <select name="type_id" id="type-selection" class="max-w-110 text-lg outline-none border-c5 border p-1 rounded-xl @error('type_id') border-red-600! @enderror" required>
                    @foreach($technics as $technic)
                        @foreach($technic->types as $type)
                            <option value="{{ $type->id }}" technic="{{ $technic->id }}" class="text-lg hidden border-c5 bg1" @if(old('type_id') == $type->id) selected @endif>{{ $type->model }}</option>
                        @endforeach
                    @endforeach

                    @if(is_null(old('type_id')))
                        <option selected disabled></option>
                    @endif
                </select>

                <x-error field="type_id" />
            </div>

            <x-group-input name="count" type="number" text="Количество" withValue="" max_width="max-w-110" placeholder="Не больше 20">
                <x-error field="count" />
            </x-group-input>

            <x-form-button>Создать</x-form-button>
        </form>

        <a href="{{ route('orders.index') }}" class="font-bold self-center text-base mt-3 text-red-600">Отмена</a>
    </div>
@endsection
