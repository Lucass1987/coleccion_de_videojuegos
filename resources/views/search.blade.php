@include('header')

Buscador
<form>
    <input type="text" name="search">

    <button type="submit">Buscar juego</button>

</form>

@if ($title)
    <div>Resultados para: {{ $title }}</div>
@endif

<div>{{ $count }} Resultados</div>
@forelse ($games as $game)
    <a href="/juegos/{{ $game->identifier }}">
        <img src="{{ $game->cover?->getUrl() }}">
        <h2>{{ $game->attributes['name'] }}</h2>

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
    </a>

@empty
    <div>No hay resultados</div>
@endforelse


@dump($games)

@include('footer')
