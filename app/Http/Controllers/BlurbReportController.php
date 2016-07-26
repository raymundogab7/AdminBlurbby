<?php

namespace Admin\Http\Controllers;

use Admin\Repositories\Interfaces\BlurbReportInterface;

class BlurbReportController extends Controller
{
    /**
     * @var BlurbReportInterface
     */
    protected $blurbReport;

    /**
     * Create a new controller instance.
     *
     * @param BlurbReportInterface $blurbReport
     * @return void
     */
    public function __construct(BlurbReportInterface $blurbReport)
    {
        $this->blurbReport = $blurbReport;
    }

    /**
     * Display administrators page.
     *
     * @return View
     */
    public function index()
    {
        $data = array(
            'blurb_reports' => $this->blurbReport->getAll(),
        );

        return view('blurb_report.index', $data);
    }
}
