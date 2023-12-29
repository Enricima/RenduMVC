<?php

namespace App\Twig;

use App\Utils\UrlGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('path', [$this, 'generatePath']),
        ];
    }

    public function generatePath(string $routeName, array $parameters = []): string
    {
        return $this->urlGenerator->generatePath($routeName, $parameters);
    }
}
