
@extends('main')

@section('title', 'Mi Colección')

@section('content')

<h1 class=titulo> Mi Colección </h1>

<form  class="buscador">
    <input class=buscadorinput type="text" name="search">

    <button type="submit" class="botoncol"> Buscar en mi colección</button>

</form>
    <button onclick="location.href='/search'" class="botoncol"> Añadir Juego</button>

<hr>

<div class="results"> Juegos en la colección:  {{ $count }} </div>
@if (!$games)
    <div class="title-result">No hay resultados</div>
@endif

@foreach ($games as $game)
    <a class="game-result" href="/juegos/{{ $game['api']->identifier }}">
        <img style="witdh: 90px;height: 105px"  src="{{ $game['api']->cover?->getUrl() ?? asset('sincaratula.jpg') }}">
        <div><h2>{{ $game['api']->attributes['name'] }}</h2>

         
            <div>
                <span>Plataformas:</span>
                @foreach ($game['database'] as $platform)
                    {{ $platform['name'] }}
                @endforeach

            </div>
        

        @if ($game['api']->attributes['first_release_date'] ?? null)
            <div>{{ $game['api']->attributes['first_release_date']->format('d-m-Y') }}</div>
        @endif
        </div>
    </a>
 
@endforeach


{{ $games_paginated->links() }}

@endsection





