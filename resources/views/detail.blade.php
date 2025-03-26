@extends('main')
@section('title', $game->attributes['name'])
@section('content')



    {{-- titulo --}}
    <h1>{{ $game->attributes['name'] }}</h1>
    <div>
        {{-- portada --}}

        <img src="{{ $game->cover->getUrl('cover_big') }}">
        <div>

            {{-- formulario --}}
            <details>
                <summary>Gestionar mi colección</summary>


                <form method="post">
                    @csrf
                    @if ($game->platforms)
                        @foreach ($game->platforms as $platform)
                            <label>
                                <input type="checkbox" name="plataformas[]" value="{{ $platform->identifier }}"
                                    @if (in_array($platform->identifier, $platforms)) checked @endif>
                                {{ $platform->attributes['name'] }}
                            </label><br>
                        @endforeach


                    @endif


                    <button type="submit">Enviar</button>
                </form>

            </details>
            <div>
                {{-- fecha de lanzamiento --}}
                @if ($game->attributes['first_release_date'] ?? null)
                    <div>{{ $game->attributes['first_release_date']->format('d-m-Y') }}</div>
                @endif


                {{-- nota --}}
                <div>{{ $game->attributes['aggregated_rating'] }}</h2>

                </div>
            </div>


        </div>


        {{-- plataformas --}}
        @if ($game->platforms)
            <div>
                <span>Plataformas:</span>
                @foreach ($game->platforms as $platform)
                    {{ $platform->attributes['name'] }},
                @endforeach

            </div>
        @endif

        {{-- generos --}}
        @if ($game->genres)
            <div>
                <span>Género/s:</span>
                @foreach ($game->genres as $genres)
                    {{ $genres->attributes['name'] }},
                @endforeach
            </div>
        @endif

        {{-- desarrolladora --}}
        @if ($game->involved_companies)
            <div>
                <span>Desarrolladora:</span>
                @foreach ($game->involved_companies as $involved_company)
                    {{ $involved_company->company->attributes['name'] }},
                @endforeach
            </div>
        @endif



        {{-- resumen --}}
        <div>{{ $game->attributes['summary'] }}</div>





        @dump($game)

    @endsection
