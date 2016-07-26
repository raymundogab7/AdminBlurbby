<?php namespace Merchant\Repositories\Eloquent;

use Merchant\BlurbCategory;
use Merchant\Repositories\Interfaces\BlurbCategoryInterface;

class BlurbCategoryEloquent implements BlurbCategoryInterface
{
    /**
     * @var BlurbCategory
     */
    private $blurbCategory;

    /**
     * Create a new BlurbCategory Eloquent instance.
     *
     * @return void
     */
    public function __construct(BlurbCategory $blurbCategory)
    {
        $this->blurbCategory = $blurbCategory;
    }

    /**
     * Get BlurbCategory by id.
     *
     * @param integer $id
     *
     * @return BlurbCategory
     */
    public function getById($id)
    {
        return $this->blurbCategory->find($id);
    }

    /**
     * Get all BlurbCategory.
     *
     * @return BlurbCategory
     */
    public function getAll()
    {
        return $this->blurbCategory->get()->toArray();
    }
}
