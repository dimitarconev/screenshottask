<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ScreenshotsApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testScreenshotAPI()
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
        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        $this->assertArrayHasKey( 'content', $jsonResponse );
        $this->assertArrayHasKey( 'mime-type', $jsonResponse );
        $this->assertEquals("200", $response->getStatusCode() );
    }
}
