<?php

namespace Application\Controllers;

use Application\Libraries\Pagination;
use Application\Models\Entities\Post;
use Application\Providers\Doctrine;
use Application\Providers\View;

class BlogController
{
    public function __construct()
    {
        // just a comment
    }

    public function index(Doctrine $doctrine, View $view, ?int $page = 1)
    {
        $limit = 10;
        $page = ($page - 1) * $limit;
        $posts = $doctrine->em->getRepository(Post::class)->getPostsPaginated($page, $limit);
        $totalItems = $doctrine->em->getRepository(Post::class)->count([]);

        $paginator = (new Pagination($totalItems, $limit, ($page / $limit) + 1, '/blog/(:num)'))
            ->getPagination();

        echo $view->render('blog.twig', compact('posts', 'paginator'));
    }

}
