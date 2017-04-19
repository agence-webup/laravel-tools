<?php

namespace Webup\LaravelTools\Breadcrumb;

class Breadcrumb
{
    private $items = [];

    public function push($title, $url)
    {
        $this->items[] = (object) [
            'title' => $title,
            'url' => $url,
        ];

        return $this;
    }

    public function items()
    {
        return $this->items;
    }
}
