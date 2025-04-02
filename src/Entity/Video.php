<?php

namespace Alura\Mvc\Entity;

class Video
{
    public readonly string $url;
    public int $id;

    public readonly string $title;

    public function __construct(
        string $url,
        string $title,
    )
    {
        $this->setUrl($url);
        $this->title = $title;
    }

    private function setUrl(string $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('URL inválida');
        }

        $this->url = $url;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
