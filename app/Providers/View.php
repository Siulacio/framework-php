<?php

namespace Application\Providers;

class View
{
    protected \Twig_Environment $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(base_path('resources/views'));
        $twig = new \Twig_Environment($loader);

        $twigFunctions = new \Twig_SimpleFunction(\TwigFunctions::class, function ($method, $params =[]) {
            return \TwigFunctions::$method($params);
        });

        $twig->addFunction($twigFunctions);

        $this->twig = $twig;
    }

    /**
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Syntax
     */
    public function render(string $view, array $data = []): string
    {
        return $this->twig->render($view, $data);
    }
}
