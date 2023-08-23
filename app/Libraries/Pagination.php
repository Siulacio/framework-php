<?php

namespace Application\Libraries;

use JasonGrimes\Paginator;

class Pagination
{
    protected Paginator $pagination;

    public function __construct($totalItems, $itemsPerPage, $page, $urlPattern)
    {
        $this->pagination = new Paginator($totalItems, $itemsPerPage, $page, $urlPattern);
    }

    public function getPagination(): Paginator
    {
        return $this->pagination;
    }

}
