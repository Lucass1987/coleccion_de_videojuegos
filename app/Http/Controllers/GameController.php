<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Enums\Image\Size;

class GameController
{
 
public function update($id, Request $request)
    {
        //dd($request->all());
        $videoconsoles = $request->post('plataformas');
        $title = $request->post('titulo');
        Collection::where('game_id', $id)->delete();
        if ($videoconsoles) {
            foreach ($videoconsoles as $videoconsole) {
                $collection = new Collection();
                $collection->game_id = $id;
                $collection->plataforma = $videoconsole;
                $collection->titulo = $title;
                $collection->save();
            }
        }

        return redirect()->route('show', ['id' => $id]);
    }


    public function show($id, Request $request)
    {
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

