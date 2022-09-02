<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;


class ScreenshotsController extends Controller
{
    public function getScreenshotBase64( Request $request ){

        $url = $request->input('url');
        $response = (new Client())->request('POST', 'https://secure.screeenly.com/api/v1/fullsize', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'key' => 'xLmhAcYYNkWk7eB8hrrimKFawX7Z9rwwjXF2G9fj4wh2MZUq3x',
                'url' => $url
            ],
        ]);
        $jsonBody = json_decode($response->getBody()->getContents(), true);

        $base64 = $jsonBody['base64_raw'];
        return response()->json([ 'content' => $base64, 'mime-type' => "image/png" ] ); 
        
    }
}
