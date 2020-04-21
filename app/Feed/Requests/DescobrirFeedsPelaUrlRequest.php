<?php

namespace App\Feed\Requests;

class DescobrirFeedsPelaUrlRequest
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function url()
    {
        return $this->url;
    }
}