{{-- @include('header') --}}
@extends('main')

@section('title', 'Buscador')

@section('content')

<h1 class=titulo> Buscador </h1>

<a class="breadcrumb" href="/">Volver al inicio</a>


<form  class="buscador">
    <input class=buscadorinput type="text" name="search">

    <button type="submit" class="botoncol"> Buscar</button>

</form>
<hr>


@if ($count)
    <div class="results"> Mostrando {{ $count }} resultados para: {{ $title }}</div>
    @else
    <div class="title-result">No hay resultados</div>
@endif


@foreach ($games as $game)
    <a class="game-result" href="/juegos/{{ $game->identifier }}">
        <img
            style="witdh: 90px;height: 105px" 
            src="{{ $game->cover?->getUrl() ?? asset('sincaratula.jpg') }}"
        >
        <div><h2>{{ $game->attributes['name'] }}</h2>

        @if ($game->platforms)
            <div>
                <span>Plataformas:</span>
                @foreach ($game->platforms as $platform)
                    {{ $platform->attributes['name'] }},
                @endforeach

            </div>
        @endif

        @if ($game->attributes['first_release_date'] ?? null)
            <div>{{ $game->attributes['first_release_date']->format('d-m-Y') }}</div>
        @endif
        </div>
    </a>
@endforeach

<div class='paginador'>
@if ($page > 0)

<a href="/search?search={{ Request::get('search') }}&page={{$page-1}}">
    <
</a>

@endif

@if ($lastpage != 1)

<span> {{$page+1}} </span>

@endif


@if ($page < $lastpage-1)
<a href="/search?search={{ Request::get('search') }}&page={{$page+1}}">
    >
</a>
    
@endif
</div>
   

@endsection

{{-- @include('footer') --}}
