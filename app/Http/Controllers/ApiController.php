<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController
{
    public function token(Request $request) {
        $response = Http::post('https://id.twitch.tv/oauth2/token', [
            'client_id' => '68jj19r4maan1ypcafcvw779ayqgri',
            'client_secret' => 'wtzgsuu2zcb8mtf2z8gdzndgnc5czd',
            'grant_type'=> 'client_credentials',
        ]);
        print_r($response->body());
        die();
    }
}
