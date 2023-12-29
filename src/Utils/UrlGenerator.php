<?php

namespace App\Utils;

class UrlGenerator
{
    private $baseURL;

    public function __construct($baseURL)
    {
        $this->baseURL = $baseURL;
    }

    public function generatePath(string $routeName, array $parameters = []): string
    {
        $url = $this->baseURL . '/' . $routeName;

        if (!empty($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }

        return $url;
    }
}
