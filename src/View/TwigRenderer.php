<?php

namespace View;

class TwigRenderer implements Renderer
{
    const CACHE_PATH = "../../cache/twig";

    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/' . self::FILES_PATH);
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => __DIR__ . '/' . self::CACHE_PATH,
        ));
    }

    public function render($name, array $data = [])
    {
        return $this->twig->render("{$name}.html.twig", $data);
    }
}
