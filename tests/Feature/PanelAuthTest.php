<?php

namespace Tests\Feature;

use Tests\TestCase;

class PanelAuthTest extends TestCase
{
    /** @test */
    public function painel_requires_basic_auth()
    {
        $response = $this->get('/painel');

        $response->assertStatus(401);
    }

    /** @test */
    public function painel_allows_with_correct_basic_auth()
    {
        $credentials = base64_encode('admin:desafio-geo');

        $response = $this->withHeaders([
            'Authorization' => "Basic {$credentials}",
        ])->get('/painel');

        $response->assertStatus(200);
    }
}
