<?php namespace Admin\Repositories\Eloquent;

use Admin\BlurbReport;
use Admin\Repositories\Interfaces\BlurbReportInterface;

class BlurbReportEloquent implements BlurbReportInterface
{
    /**
     * @var BlurbReport
     */
    private $blurbReport;

    /**
     * Create a new BlurbReport Eloquent instance.
     *
     * @return void
     */
    public function __construct(BlurbReport $blurbReport)
    {
        $this->blurbReport = $blurbReport;
    }

    /**
     * Get BlurbReport by id.
     *
     * @param integer $id
     *
     * @return BlurbReport
     */
    public function getById($id)
    {
        return $this->blurbReport->find($id);
    }

    /**
     * Get all BlurbReport.
     *
     * @return BlurbReport
     */
    public function getAll()
    {
        return $this->blurbReport->with(['merchant', 'blurb', 'appUser'])->get()->toArray();
    }
}
