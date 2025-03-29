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
        <img style="witdh: 90px;height: 105px"  src="{{ $game->cover?->getUrl() ?? 'https://us.123rf.com/450wm/koblizeek/koblizeek2208/koblizeek220800128/190320173-sin-s%C3%ADmbolo-de-vector-de-imagen-falta-el-icono-disponible-no-hay-galer%C3%ADa-para-este-marcador-de.jpg' }}">
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




@endsection

{{-- @include('footer') --}}
