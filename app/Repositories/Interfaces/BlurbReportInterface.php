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
     * Update a blurb report.
     *
     * @param integer $id
     * @return integer
     */
    public function update($id, $payload);

    /**
     * Delete a BlurbReport.
     *
     * @param integer $id
     * @return integer
     */
    public function delete($id);

}
