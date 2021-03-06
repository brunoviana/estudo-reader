<?php

namespace App\Repositories;

use MeusFeeds\Feeds\Domain\Entities\Feed;
use App\Mappers\FeedMapper;

use App\Models\Feed as FeedModel;
use MeusFeeds\Feeds\Domain\Repositories\FeedRepositoryInterface;

class FeedRepository implements FeedRepositoryInterface
{
    public function buscar(int $id)
    {
        $feedModel = FeedModel::where('usuario_id', auth()->user()->id)
                                    ->where('id', $id)
                                    ->first();

        if ($feedModel) {
            return FeedMapper::criaEntidade($feedModel);
        }

        return null;
    }

    public function buscarPeloLink(string $link)
    {
        $feedModel = FeedModel::where('usuario_id', auth()->user()->id)
                                ->where('link_rss', $link)
                                ->first();

        if ($feedModel) {
            return FeedMapper::criaEntidade($feedModel);
        }

        return null;
    }

    public function salvar(Feed $feed) : void
    {
        $feedModel = FeedMapper::criaModel($feed);

        if (!$feedModel->id) {
            $feedModel->usuario_id = auth()->user()->id;
        }

        $feedModel->save();

        if (!$feed->id()) {
            $feed->id(
                $feedModel->id
            );
        }
    }
}
