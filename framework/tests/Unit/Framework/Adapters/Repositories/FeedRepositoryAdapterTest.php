<?php

namespace Tests\Unit\Framework\Adapters\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use Framework\Adapters\Repositories\FeedRepositoryAdapter;
use Framework\Models\Feed as FeedModel;

use App\Feed\Responses\CriarNovoFeedResponse;

use Domain\Feed\Entities\Feed;

class FeedRepositoryAdapterTest extends TestCase
{
    use RefreshDatabase;

    public function test_FeedRepository_Deve_Feed_Buscar_Pelo_Link()
    {
        factory(FeedModel::class, 1)->create([
            'titulo' => 'Blog do Bruno',
            'link_rss' => 'https://brunoviana.dev/rss.xml'
        ]);

        $repository = new FeedRepositoryAdapter();
        $feed = $repository->buscarPeloLink('https://brunoviana.dev/rss.xml');

        $this->assertInstanceOf(Feed::class, $feed);
        $this->assertEquals('Blog do Bruno', $feed->titulo());
    }

    public function test_FeedRepository_Deve_Savar_E_Retornar_Response()
    {
        $feed = new Feed('Blog do Bruno', 'https://brunoviana.dev/rss.xml');

        $repository = new FeedRepositoryAdapter();
        $id = $repository->save($feed);

        $this->assertEquals(1, $id);
        $this->assertCount(1, FeedModel::all());
    }
}