{{-- @include('header') --}}
@extends('main')

@section('title', 'Buscador')

@section('content')

<h1> Buscador </h1>


<form>
    <input type="text" name="search">

    <button type="submit">@include('lupa')</button>

</form>

@if ($title)
    <div class="title-result">Resultados para: {{ $title }}</div>
@endif

@if ($count)
    <div class="results">{{ $count }} Resultados</div>
@endif


@foreach ($games as $game)
    <a class="game-result" href="/juegos/{{ $game->identifier }}">
        <img src="{{ $game->cover?->getUrl() }}">
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

@if ($title && $count == 0)
    <div class="title-no-result">No hay resultados</div>
@endif


@dump($games)

@endsection

{{-- @include('footer') --}}
