<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Enums\Image\Size;

class GameController
{
    //añade un juego a la colección
    public function add($id)
    {
        //crea un nuevo objeto de la clase Collection
        $collection = new Collection();
        //asigna el valor de game_id a la id que se le pasa por parámetro
        $collection->game_id = $id;
        //guarda el objeto en la base de datos
        $collection->save();

        //redirige a la página de detalles del juego
        return redirect('/juegos/' . $id);
    }

    //elimina un juego de la colección
    public function remove($id)
    {
        //busca el juego en la colección por id
        $collection = Collection::where('game_id', $id)->first();
        //elimina el juego de la colección
        $collection->delete();

        //redirige a la página de detalles del juego
        return redirect('/juegos/' . $id);
    }

    public function show($id, Request $request)
    {
        $videoconsoles = $request->post('plataformas');
        if ($videoconsoles) {
            Collection::where('game_id', $id)->delete();
            foreach ($videoconsoles as $videoconsole) {
                $collection = new Collection();
                $collection->game_id = $id;
                $collection->plataforma = $videoconsole;
                $collection->save();
            }
        }

       //del listado de juegos me añades las relaciones de portadas y plataformas
        $game = Game::with(['cover', 'platforms', 'genres', 'involved_companies.company'])
        //dame el juego que pertenece a esta id coge el valor de id y lo convierte a entero
            ->find((int) $id);

        //obtén todos los registros del modelo Collection donde el game_id sea igual a $id
        $platforms = Collection::where('game_id', $id)->get()->map(function ($item) {
            return $item->plataforma;
        })->toArray();

        return view('detail', ['game' => $game, 'platforms' => $platforms]);
    }
}

