<?php

namespace Framework\Repositories;

use Feed\Domain\Entities\Feed;
use Framework\Mappers\FeedMapper;

use Framework\Models\Feed as FeedModel;
use Feed\Domain\Repositories\FeedRepositoryInterface;

class FeedRepository implements FeedRepositoryInterface
{
    public function buscar(int $id)
    {
        $feedModel = FeedModel::find($id);

        if ($feedModel) {
            return FeedMapper::criaEntidade($feedModel);
        }

        return null;
    }

    public function buscarPeloLink(string $link)
    {
        $feedModel = FeedModel::where('link_rss', $link)->first();

        if ($feedModel) {
            return FeedMapper::criaEntidade($feedModel);
        }

        return null;
    }

    public function salvar(Feed $feed) : void
    {
        $feedModel = FeedMapper::criaModel($feed);

        $feedModel->save();

        if (!$feed->id()) {
            $feed->id(
                $feedModel->id
            );
        }
    }
}
