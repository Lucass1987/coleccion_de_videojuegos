@extends('main')
@section('title', $game->attributes['name'])
@section('content')



    {{-- titulo --}}
    <h1 style="margin-top: 1em" class=titulo>{{ $game->attributes['name'] }}</h1>
    <a class="breadcrumb" href="/">Volver al inicio</a>
    <a class="breadcrumb" href="/search">Volver al buscador</a>
    <div class='inline'>
        {{-- portada --}}
@if ($game->cover)
        <img class=portada src="{{ $game->cover->getUrl('cover_big') }}">
@else
            <img  style="witdh: 90px;height: 105px"  src="{{ asset('sincaratula.jpg')}}">
@endif
        <div>


  <div class='inline'>
               <div class=puntuaciontxt> Puntuación:</div>
              

                {{-- nota --}}
                 @if ($game->attributes['aggregated_rating'] ?? null)
                    <div class=puntuacion>{{ round($game->attributes['aggregated_rating'],2)}}</div>
                 @else
                    <div>Sin puntuación</div>   
                @endif
                
            </div>



            {{-- formulario --}}
            <details>
                <summary class=botoncol>Gestionar mi colección</summary>


                <form method="post">
                    @csrf
                    <input type="hidden" name="titulo" value="{{ $game->attributes['name'] }}">
                    @if ($game->platforms)
                        @foreach ($game->platforms as $platform)
                            <label class=caja>
                                <input class=cajacheck type="checkbox" name="plataformas[]" value="{{ $platform->identifier }}"
                                    @if (in_array($platform->identifier, $platforms)) checked @endif>
                                {{ $platform->attributes['name'] }}
                            </label><br>
                        @endforeach


                    @endif

            <div style="text-align: center; margin: 10px;">

                    <button class=botoncol type="submit">Enviar</button>
                    </div>
                </form>

            </details>
          


        </div>
    </div>
 {{-- fecha de lanzamiento --}}
                @if ($game->attributes['first_release_date'] ?? null)
                    <span class=titulos>Fecha de lanzamiento: </span>
                     <span class="generos">{{ $game->attributes['first_release_date']->format('d-m-Y') }}</span>
                @endif

        {{-- plataformas --}}
        @if ($game->platforms)
            <div class=datos>
                <span class=titulos>Plataformas:</span>
                @foreach ($game->platforms as $platform)
                    <span class="generos">{{ $platform->attributes['name'] }}</span>
                @endforeach

            </div>
        @endif

        {{-- generos --}}
        @if ($game->genres)
            <div class=datos>
                <span class=titulos>Género/s:</span>
                @foreach ($game->genres as $genres)
                    <span class="generos">{{ $genres->attributes['name'] }}</span>
                @endforeach
            </div>
        @endif

        {{-- desarrolladora --}}
        @if ($game->involved_companies)
            <div class=datos>
                <span class=titulos>Desarrolladora:</span>
                @foreach ($game->involved_companies as $involved_company)
                    <span class="generos">{{ $involved_company->company->attributes['name'] }}</span>
                @endforeach
            </div>
        @endif



        {{-- resumen --}}
        <div class=descripcion>{{ $game->attributes['summary'] ?? "Sin descripcion"}}</div>



    @endsection
<script> 
        function setScoreColor(element) {
        let score = parseInt(element.textContent, 10);
        let red, green;

        if (score <= 25) {
            red = 255;
            green = Math.floor((score / 25) * 100); // De rojo puro a tonos rojizos-naranja
        } else if (score <= 50) {
            red = 255;
            green = Math.floor(100 + ((score - 25) / 25) * 155); // De naranja a amarillo
        } else if (score <= 75) {
            red = Math.floor(255 - ((score - 50) / 25) * 255); // De amarillo a verde-amarillo
            green = 255;
        } else {
            red = 0;
            green = 255; // Verde puro
        }
        element.style.backgroundColor ="rgb("+red+", "+green+", 0)";
    }
document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".puntuacion").forEach(setScoreColor);
    });
</script>