@extends('layouts.dashboard-app')

@section('title', 'Dashboard - Home')

@section('content')
    <section class="my-4">
        @component('components.dashboard.card')
        <h2 class="text-lg font-semibold">Konten 1</h2>
        <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
    </section>


    <section class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
        @component('components.dashboard.card', ['class' => 'lg:col-span-2'])
        <h2 class="text-lg font-semibold">Konten 1</h2>
        <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
        @component('components.dashboard.card')
        <h2 class="text-lg font-semibold">Konten 1</h2>
        <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
    </section>

    <section class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-6 gap-4 my-4">
        @component('components.dashboard.card')
            <h2 class="text-lg font-semibold">Konten 1</h2>
            <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
        @component('components.dashboard.card')
            <h2 class="text-lg font-semibold">Konten 1</h2>
            <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
    </section>

    <section class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @component('components.dashboard.card')
            <h2 class="text-lg font-semibold">Konten 1</h2>
            <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
        @component('components.dashboard.card')
            <h2 class="text-lg font-semibold">Konten 1</h2>
            <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
        @component('components.dashboard.card')
            <h2 class="text-lg font-semibold">Konten 1</h2>
            <p>Ini adalah isi dari kartu pertama.</p>
        @endcomponent
    </section>
@endsection
