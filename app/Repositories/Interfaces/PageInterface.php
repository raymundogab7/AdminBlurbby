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

    /**
     * Update Page by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function updateById($id, $payload);
}
