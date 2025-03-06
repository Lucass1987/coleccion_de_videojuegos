<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;

class SearchController
{
    public function index(Request $request)
    {
        //coge la query entera y dame el valor search y guarde en la variable "title"
        $title = $request->query('search');
        //coge la query entera y dame el valor page y guarda en la variable page
        $page = $request->query('page');

        // si title tiene valor
        if ($title) {
            //buscame los juegos por title y devuelveme el total
            $count = Game::search($title)->count();
            // buscame los juegos 
            $games = Game::search($title)
                // paginador 
                ->offset($page * 10 ?? 0)
                // con sus relaciones de caratula y plataforma 
                ->with(['cover', 'platforms'])
                //damelo damelo, damelo ya
                ->get();
        }
        //muestrame la plantilla search, con los datos ..... ...  
        return view('search', ['title' => $title, 'games' => $games ?? [], 'count' => $count ?? null]);
    }
}
