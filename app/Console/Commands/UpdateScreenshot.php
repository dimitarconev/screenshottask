<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UpdateScreenshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screenshot:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = (new Client())->request('POST', 'http://127.0.0.1:8000/v1/screenshots', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'key' => 'xLmhAcYYNkWk7eB8hrrimKFawX7Z9rwwjXF2G9fj4wh2MZUq3x',
                'url' => "https://www.google.com"
            ],
        ]);
        $jsonBody = json_decode($response->getBody()->getContents(), true);
        $base64 =  "data:image/png;base64, ". $jsonBody['content'];
        $extension = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];
        $replace = substr($base64, 0, strpos($base64, ',')+1); 
        $image = str_replace($replace, '', $base64); 
        $image = str_replace(' ', '+', $image); 

        $imageName = Str::random(10).'.'.$extension;
       
        Storage::disk('public')->put($imageName, base64_decode($image));
        $jsonBody = json_decode($response->getBody()->getContents(), true);
    }
}
