<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Platform;

use function Laravel\Prompts\form;

class HomeController
{
    public function index(Request $request)
    {
        $games_all = Collection::select('game_id')->distinct()->get();
        $busqueda = $request->query('search');
        $games_paginated = Collection::select('game_id')->where('titulo','like', "%{$busqueda}%")->orderby('created_at','desc')->distinct()->paginate(5);
        foreach ($games_paginated->items() as $key => $value) {
            $games[$key]['api'] = Game::with(['cover', 'platforms', 'genres', 'involved_companies.company'])
                ->find((int) $value->game_id);

            $games[$key]['database'] = Collection::where('game_id', $value->game_id)->get()->map(function ($item) {
                return Platform::find((int) $item->plataforma);
            })->toArray();
        }

        $count = count($games_all);




        return view('welcome', [
            'games' => $games ?? [],
            'page' => $page ?? 0,
            'lastpage' => $count ? ceil($count / 5) : 1,
            'count' => $count,
            'games_paginated' => $games_paginated,
        ]);
    }
}
