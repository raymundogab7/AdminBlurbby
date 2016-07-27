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
     * @param array $attributes
     * @return BlurbReport
     */
    public function getAll(array $attributes);

    /**
     * Delete a BlurbReport.
     *
     * @param integer $id
     * @return integer
     */
    public function delete($id);

}
