<?php namespace Merchant\Repositories\Interfaces;

use Merchant\BlurbCategory;

interface BlurbCategoryInterface
{
    /**
     * Get BlurbCategory by id.
     *
     * @param integer $id
     *
     * @return BlurbCategory
     */
    public function getById($id);

    /**
     * Get all BlurbCategory.
     *
     * @return BlurbCategory
     */
    public function getAll();

}
