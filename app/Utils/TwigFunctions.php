<?php

namespace Application\Utils;

use Aura\Session\Session;

class TwigFunctions
{
    static $container;

    public static function setContainer(\Psr\Container\ContainerInterface $container)
    {
        self::$container = $container;
    }

    public static function base_url(string $url)
    {
        base_url($url);
    }

    public static function first_uri_segment()
    {
        $page = explode('/', substr($_SERVER['REQUEST_URI'], 1), 2);
        return str_replace("-", " ", $page[0]);
    }

    public static function flash($params): mixed
    {
        $session = self::session();
        $flash = $session->getSegment('Blog')->getFlash($params[0]);

        if ($flash) {
            if ($params[0] === 'post') {
                return $flash;
            }

            return sprintf(
                "<div style='width: %s' class='alert alert-%s'>%s</div>",
                '100%',
                $params[1],
                $flash
            );
        }

        return null;
    }

    public function user_is_logged(): mixed
    {
        $session = self::session();
        return $session->getSegment('Blog')->get('user');
    }

    public static function session(): Session
    {
        return self::$container->get(Session::class);
    }
}
