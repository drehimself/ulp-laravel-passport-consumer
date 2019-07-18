<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $query = http_build_query([
        'client_id' => 3,
        'redirect_uri' => 'http://ulp-laravel-passport-consumer.test/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://ulp-laravel-passport.test/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://ulp-laravel-passport.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 3,
            'client_secret' => 'zniXAauFo7gPtJFfemBUNfSKguJt37dRJqgKMf5b',
            'redirect_uri' => 'http://ulp-laravel-passport-consumer.test/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
