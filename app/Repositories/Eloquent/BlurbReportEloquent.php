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
        return $this->blurbReport->with(['merchant' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        }])
            ->find($id);
    }

    /**
     * Get all BlurbReport.
     *
     * @param array $attributes
     * @return BlurbReport
     */
    public function getAll(array $attributes)
    {
        return $this->blurbReport->with(['merchant', 'blurb', 'appUser', 'restaurant', 'campaign'])->where($attributes)->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Update a blurb report.
     *
     * @param integer $id
     * @return integer
     */
    public function update($id, $payload)
    {
        return $this->blurbReport->where('id', $id)->update($payload);
    }

    /**
     * Delete a BlurbReport.
     *
     * @param integer $id
     * @return integer
     */
    public function delete($id)
    {
        return $this->blurbReport->find($id)->delete();
    }
}
