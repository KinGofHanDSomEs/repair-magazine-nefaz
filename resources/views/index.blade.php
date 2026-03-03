@extends('layouts.app')

@section('title', 'Главная')

@section('main')
    <div class="container py-5 mx-auto c2">
        <div class="banner c3 relative h-80 w-full overflow-hidden rounded-2xl flex justify-center items-center">
            <img src="{{ asset('images/index/nefaz.webp') }}" alt="nefaz"
                 class="w-full object-cover object-center absolute rounded-2xl">

            <div class="bgt1 absolute p-3 flex flex-col justify-center items-center rounded-2xl">
                <h1 class="font-bold text-3xl">НЕФАЗ</h1>
                <p class="text-center bottom-25 text-xl max-w-120">Крупнейший в России завод по производству спецнадстроек на шасси КАМАЗ и многое другое</p>
            </div>
        </div>

        <hr class="my-5 border-c2">

        <div class="heading mb-4">
            <h1 class="font-bold text-xl text-center c2">Ремонт техники</h1>
        </div>

        <x-error field="error" />

        <div class="catalog grid gap-5 grid-cols-4">
            @foreach($technics as $technic)
                <a href="{{ route('orders.create') }}" class="technic bgt4 flex flex-col justify-between rounded-xl p-3">
                    <h3 class="text-center text-sm mb-5 c3 font-bold">{{ $technic->name }}</h3>
                    <img src="{{ asset($technic->image_url) }}" alt="{{ $technic->name }}">
                </a>
            @endforeach
        </div>
    </div>
@endsection
