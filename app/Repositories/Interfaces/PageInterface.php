<?php namespace Admin\Repositories\Interfaces;

use Admin\Page;

interface PageInterface
{
    /**
     * Get Page by id.
     *
     * @param integer $id
     *
     * @return Page
     */
    public function getById($id);
}