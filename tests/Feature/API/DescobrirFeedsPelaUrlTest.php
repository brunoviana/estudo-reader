<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Services\ExtratorDeFeeds;

use Illuminate\Foundation\Testing\RefreshDatabase;

class DescobrirFeedsTest extends TestCase
{
    use RefreshDatabase;

    public function test_Api_Deve_Descobrir_Feeds_Com_Sucesso()
    {
        $this->mock(ExtratorDeFeeds::class, function ($mock) {
            $mock->shouldReceive('extrair')->andReturn([
                [
                    'titulo' => 'Blog do Bruno',
                    'link_rss' => 'https://brunoviana.dev/',
                    'descricao' => 'Este é meu blog',
                    'ultimos_artigos' => [
                        'Artigo 1',
                        'Artigo 2',
                        'Artigo 3',
                    ]
                ],
            ]);
        });

        $response = $this->post('/api/feeds/descobrir', [
            'url' => 'https://brunoviana.dev'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        [
                            'titulo' => 'Blog do Bruno',
                            'link_rss' => 'https://brunoviana.dev/',
                            'descricao' => 'Este é meu blog',
                            'ultimos_artigos' => [
                                'Artigo 1',
                                'Artigo 2',
                                'Artigo 3',
                            ]
                        ]
                    ]
                ]);
    }
}
