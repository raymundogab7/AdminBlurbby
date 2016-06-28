<?php namespace Admin\Repositories\Eloquent;

use Admin\Page;
use Admin\Repositories\Interfaces\PageInterface;

class PageEloquent implements PageInterface
{
    /**
     * @var Page
     */
    private $page;

    /**
     * Create a new Page Eloquent instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Get Page by id.
     *
     * @param integer $id
     *
     * @return Admin
     */
    public function getById($id)
    {
        return $this->page->find($id);
    }
}
