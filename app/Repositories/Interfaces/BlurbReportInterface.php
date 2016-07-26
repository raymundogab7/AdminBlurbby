<?php namespace Admin\Repositories\Interfaces;

use Admin\BlurbReport;

interface BlurbReportInterface
{
    /**
     * Get BlurbReport by id.
     *
     * @param integer $id
     *
     * @return BlurbReport
     */
    public function getById($id);

    /**
     * Get all BlurbReport.
     *
     * @return BlurbReport
     */
    public function getAll();

}
