<?php

namespace Framework\Repositories;

use Feed\Domain\Entities\Artigo;
use Framework\Mappers\ArtigoMapper;

use Framework\Models\Artigo as ArtigoModel;
use Feed\Domain\Repositories\ArtigoRepositoryInterface;

class ArtigoRepository implements ArtigoRepositoryInterface
{
    public function todos() : array
    {
        $artigos = [];

        foreach (ArtigoModel::all() as $artigoModel) {
            $artigos[] = ArtigoMapper::criaEntidade($artigoModel);
        }

        return $artigos;
    }

    public function salvar(Artigo $artigo) : void
    {
        $artigoModel = ArtigoMapper::criaModel($artigo);

        $artigoModel->save();

        if (!$artigo->id()) {
            $artigo->id(
                $artigoModel->id
            );
        }
    }

    public function salvarVarios(array $artigos) : void
    {
        foreach ($artigos as $artigo) {
            $this->salvar($artigo);
        }
    }
}
